#!/bin/bash

# get the new data
python3 get_and_analyse.py

# remove duplicates
for file in data/uutisotsikot/*.txt; do
    [ -f "$file" ] || continue
    sort -u -o  "$file" "$file"
done

