

## A. Required Information
### A.1. Requirement Completion Rate
- [x] List all pharmacies open at a specific time and on a day of the week if requested.
    - Implemented at http://localhost:1234/api/searchByOpeningHours API.
- [x] List all masks sold by a given pharmacy, sorted by mask name or price.
    - Implemented at http://localhost:1234/api/getMasks API.
- [x] List all pharmacies with more or less than x mask products within a price range.
    - Implemented at http://localhost:1234/api/priceAndKind API.
- [x] The top x users by total transaction amount of masks within a date range.
    - Implemented at http://localhost:1234/api/topBuyer API.
- [x] The total number of masks and dollar value of transactions within a date range.
    - Implemented at http://localhost:1234/api/statisticsByDate API.
- [x] Search for pharmacies or masks by name, ranked by relevance to the search term.
    - Implemented at http://localhost:1234/api/keywordSearch API.
- [x] Process a user purchases a mask from a pharmacy, and handle all relevant data changes in an atomic transaction.
    - Implemented at http://localhost:1234/api/buyMask API.



### A.2. API Document
API_Document.yaml

### A.3. Import Data Commands
請在docker container: php-T 中執行

```bash
$ cd /var/www/pharmacy 
$ php artisan pharmacy-init
```


## B. Bonus Information

>  If you completed the bonus requirements, please fill in your task below.
### B.1. Test Coverage Report

Null


### B.2. Dockerized

請執行根目錄下 docker-compose.yml

```bash
$ docker-compose up -d
```
