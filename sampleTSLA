import requests

url = "https://alpha-vantage.p.rapidapi.com/query"

querystring = {"symbol":"TSLA","function":"GLOBAL_QUOTE"}

headers = {
    'x-rapidapi-host': "alpha-vantage.p.rapidapi.com",
    'x-rapidapi-key': "72ffde7ff7msha7a06602e3f6a57p1fac76jsn40e29860cc3a"
    }

response = requests.request("GET", url, headers=headers, params=querystring)

print(response.text)
