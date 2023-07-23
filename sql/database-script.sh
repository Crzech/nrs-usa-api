#!/bin/bash
db_password='P0stGr3s4dm!n'
seeding_dir='./seeding/*'

for file in *
do
    # Check if the file has a ".sql" extension
    if [[ $file == *.sql ]]; then
        echo "**Importing $file **"
        PGPASSWORD=$db_password psql -h localhost -p 5433 -U admin -d usapopulation -f $file -a
    fi
done


declare -A csv_column_mapping
declare -A psql_column_mapping
csv_column_mapping=(
    [States]="(state_id, name, abbreviation)"
    [Counties]="(county_id, name, state_id, population)"
)
psql_column_mapping=(
    [States]="name, abbreviation"
    [Counties]="name, state_id, population"
)

# Database seeding
for f in $seeding_dir
do
    if [[ $f == *.csv ]]; then
        csv_file=$(realpath $f)
        file_name=$(echo $(basename $f) | sed 's/.csv//g')
        lower_table_name=$( echo $(echo "$file_name" | sed 's/[0-9]//g') | sed 's/\-//g')
        table_name=$(echo "${lower_table_name^}")
        csvColumns=${csv_column_mapping[$table_name]}
        psqlColumns=${psql_column_mapping[$table_name]}
        echo "** SEEDING $table_name **"
        # Creates tmp tables
        PGPASSWORD=$db_password psql -h localhost -p 5433 -U admin -d usapopulation -c "CREATE TABLE IF NOT EXISTS ${table_name}_tmp AS TABLE $table_name WITH NO DATA"
        # Dealing with escaping and inserting into temp table
        copystmt=$(echo -e "COPY ${table_name}_tmp $csvColumns from STDIN WITH (FORMAT CSV, DELIMITER \",\", HEADER);" )
        com="PGPASSWORD=$db_password psql -h localhost -p 5433 -U admin -d usapopulation -c '$copystmt' < $csv_file"
        eval $com
        # Performing another copy to insert columns without serial values
        insertStmt="
            INSERT INTO $table_name ($psqlColumns)
            SELECT $psqlColumns FROM ${table_name}_tmp;
        "
        PGPASSWORD=$db_password psql -h localhost -p 5433 -U admin -d usapopulation -c "$insertStmt" -a

        # Deleting temp table
        PGPASSWORD=$db_password psql -h localhost -p 5433 -U admin -d usapopulation -c "DROP TABLE IF EXISTS ${table_name}_tmp;"
        echo "** SEEDING $table_name FINISHED **"
    fi
done


