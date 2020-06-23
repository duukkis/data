# coding=utf-8
import json
from urllib.request import Request, urlopen
from pprint import pprint
import libvoikko

# Define a Voikko class for Finnish
v = libvoikko.Voikko(u"fi")
# location of high.fi newsfeed
url = 'http://www.palomaki.info/...';

feed = Request(url, headers={'User-Agent': 'Mozilla/5.0'})

with urlopen(feed) as response:
  response_content = response.read()
  dada = json.loads(response_content)
  entries = dada["responseData"]["feed"]["entries"]
  for data in entries:
    title = data['title']
    txt = title.lower().replace(".", "").replace(",", "")
    word_list = txt.split(" ")
    for w in word_list:
       res = v.analyze(w)
       if res:
          file_object = open('data/uutisotsikot/' + res[0]["CLASS"] + '.txt', 'a')
          file_object.write(res[0]["BASEFORM"] + "\n")
          file_object.close()
