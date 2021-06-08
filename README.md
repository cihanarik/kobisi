Veritabanına tabloların oluşması ve Örnek verilerin aktarımı için gereken komutlar

```
php artisan db:migrate

php artisan db:seed --class=PackageSeeder
php artisan db:seed --class=CompanySeeder
php artisan db:seed --class=ApiKeySeeder
```

# API endpoint'ler #
- /api/json/companies [POST] #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm

- /api/json/companies #Response;
	- Content-Type: application/json
```json
{
	"data": [
		{
			"id": 1,
			"name": "Precious",
			"lastname": "Balistreri",
			"email": "tyshawn.schulist@kuhn.info",
			"company_name": "Harber PLC",
			"site_url": "http://schaden.com/voluptas-aut-ea-rerum-officia-eum",
			"status": 1
		},
		{
			"id": 2,
			"name": "Wilfrid",
			"lastname": "Senger",
			"email": "oconner.jared@fay.com",
			"company_name": "Ziemann-Langworth",
			"site_url": "https://brown.net/tempore-distinctio-quis-quia-quia.html",
			"status": 1
		},
	 ]
}
```

- /api/json/company/detail/1 [POST] #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm        OR     Token: Y2loYW5AY2loYW4xLmNvbS1odHRwOi8vd3d3LmNpaGFuLmNvbQ==
	
- /api/json/company/detail/1 #Response;
	- Content-Type: application/json
```json
{
	"data": [{
			"id": 1,
			"name": "Precious",
			"lastname": "Balistreri",
			"email": "tyshawn.schulist@kuhn.info",
			"company_name": "Harber PLC",
			"site_url": "http://schaden.com/voluptas-aut-ea-rerum-officia-eum",
			"status": 1
		}]
}
```	

- /api/json/company/create [POST] #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm
```json
{
	"site_url": "http://www.cihanarik.com",
	"name": "Cihan",
	"lastname": "ARIK",
	"company_name": "Cihan ARIK PLC",
	"email": "yazilimciniz@gmail.com",
	"password": "12345678" 
}
```
- /api/json/company/create #Response;
	- Content-Type: application/json
```json
{
	"status": "success",
	"message": {
		"token": "Y2loYW5AY2loYW41LmNvbS1odHRwOi8vd3d3LmNpaGFuLmNvbQ==",
		"company_id": 103
	}
}
```	

- /api/json/company/subscription/create [POST] #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm        OR     Token: Y2loYW5AY2loYW4xLmNvbS1odHRwOi8vd3d3LmNpaGFuLmNvbQ==
	- "cycle" values : monthly or yearly
```json
{
	"company_id": 1,
	"package_id": 1,
	"cycle": "monthly"
}
```

- /api/json/company/subscription/create #Response;
	- Content-Type: application/json
```json
{
	"status": "success",
	"message": {
			"start_date": "2021-06-08T22:13:01.861696Z",
			"end_date": "2021-07-08T22:13:01.861740Z",
			"package": {
				"id": 6,
				"name": "Prime",
				"price_month": 2499,
				"price_year": 25490
			}
		   }
}
```
		
- /api/json/company/subscription/create [POST] #OPTIONAL FIELDS ( custom date range ) #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm        OR     Token: Y2loYW5AY2loYW4xLmNvbS1odHRwOi8vd3d3LmNpaGFuLmNvbQ==
```json
{
	"company_id": 1,
	"package_id": 1,
	"start_date": "2021-06-08",
	"end_date": "2023-06-08"
}
```

- /api/json/company/subscription/create #OPTIONAL FIELD ( custom date range ) #Response;
	- Content-Type: application/json
```json
{
	"status": "success",
	"message": {
			"start_date": "2021-06-08T00:00:00.000000Z",
			"end_date": "2023-06-08T00:00:00.000000Z",
			"package": {
				"id": 6,
				"name": "Prime",
				"price_month": 2499,
				"price_year": 25490
			}
		    }
}
```		

- /api/json/company/package/1 [POST] #Request;
	- Content-Type: application/json
	- Accept: application/json
	- Authorization: 4NuJA4fhUf6V1ED0ENVm        OR     Token: Y2loYW5AY2loYW4xLmNvbS1odHRwOi8vd3d3LmNpaGFuLmNvbQ==

- /api/json/company/package/1 #Response;
	- Content-Type: application/json
```json
{
	"status": "success",
	"message": [
			{
				"id": 1,
				"site_url": "http://schaden.com/voluptas-aut-ea-rerum-officia-eum",
				"name": "Precious",
				"lastname": "Balistreri",
				"company_name": "Harber PLC",
				"email": "tyshawn.schulist@kuhn.info",
				"status": 1,
				"company_package": {
					"id": 1,
					"package_id": 6,
					"company_id": 1,
					"start_date": "2020-09-29 20:21:30",
					"end_date": "2020-10-29 20:21:30",
					"cycle": "yearly",
					"package": {
						"id": 6,
						"name": "Prime",
						"price_month": 2499,
						"price_year": 25490
					}
				}
			}
		]
}
```
