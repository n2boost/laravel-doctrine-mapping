ge:
	php artisan n2boost:orm:generate-entities

ups:
	php artisan n2boost:orm:scheme-tool:update

ci:
	git add .
	git commit
	git pull
	git push