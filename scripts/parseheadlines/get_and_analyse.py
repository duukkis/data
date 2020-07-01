# coding=utf-8
import json
from urllib.request import Request, urlopen
from pprint import pprint
import libvoikko
import time
import re
from vars import url

# helper function to determine good and bad words
def goodOrBadWord(word):
  if len(word) == 1:
     return 0
  elif re.compile('\d').match(word):
     return 0
  elif re.compile('-[a-zäöåA-ZÄÖÅ]').match(word):
     return 0
  elif re.compile('\'[a-zäöåA-ZÄÖÅ]').match(word):
     return 0
  elif re.compile('[a-zäåöA-ZÄÖÅ]+-Aalto').match(word):
     return 0
  elif re.compile('[a-zäåöA-ZÄÖÅ]+-Ilta').match(word):
     return 0
  elif re.compile('[a-zäåöA-ZÄÖÅ]+-Arvonen').match(word):
     return 0
  else:
    return 1

# Define a Voikko class for Finnish
v = libvoikko.Voikko(u"fi")

words = dict()
words["asemosana"] = [];
words["etunimi"] = [];
words["huudahdussana"] = [];
words["kieltosana"] = [];
words["laatusana"] = [];
words["lukusana"] = [];
words["lyhenne"] = [];
words["nimi"] = [];
words["nimisana"] = [];
words["nimisana_laatusana"] = [];
words["paikannimi"] = [];
words["seikkasana"] = [];
words["sidesana"] = [];
words["suhdesana"] = [];
words["sukunimi"] = [];
words["teonsana"] = [];
words["etuliite"] = [];

cats = ["uutiset", "ulkomaat", "kotimaa", "talous", "media", "urheilu", "tiede", "viihde", "politiikka", "paikallisuutiset"]
for cat in cats: 
  time.sleep(1)
  feed = Request(url + cat, headers={'User-Agent': 'Mozilla/5.0'})

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
            sana = res[0]["BASEFORM"]
            muoto = res[0]["CLASS"]
            if sana not in words[muoto] and goodOrBadWord(sana):
                words[muoto].append(sana)

# append things into file
for file, col in enumerate(words):
   file_object = open('data/uutisotsikot/' + col + '.txt', 'a')
   for sana in words[col]:
      file_object.write(sana + "\n")

   file_object.close()

