#!/bin/bash

# get the new data
python3 get_and_analyse.py

# remove duplicates
for file in data/uutisotsikot/*.txt; do
    [ -f "$file" ] || continue
    sort -u -o  "$file" "$file"
done

# remove number lines from lukusana
sed -i '/^[[:digit:]]*$/d' data/uutisotsikot/lukusana.txt
