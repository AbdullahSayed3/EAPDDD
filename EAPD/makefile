after-pull:
	rm -rf composer.lock && composer install && composer validate && php artisan migrate && php artisan db:seed &&  php artisan optimize:clear && php artisan cache:clear && php artisan config:clear && php artisan permission:cache-reset

