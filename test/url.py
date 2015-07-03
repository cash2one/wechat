import urllib

query_args = {'q':'query string', 'foo':'bar'}
encoded_args = urllib.urlencode(query_args)
url = 'http://localhost:80/wechat_server/test/testurl.php?q=123&ret=ha world'
#print urllib.urlopen(url, encoded_args).read()
print urllib.urlopen(url).read()
