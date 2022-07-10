# MonoTask

## Задание: https://www.evernote.com/l/AL7WZoZ6SDFGH6BJ-5QoyAN2KianRLsKKvg (Если это в публичной репе хранить нельзя жду поправок я удалю)
## Do not forget
### From project directory
- Get composer in folder, get rid of ``` composer-setup.php ```
- Install laravel after getting composer.phar  ``` php composer.phar global require laravel/installer ```  
- Create project ``` php composer.phar create-project --prefer-dist laravel/laravel {projectName} ```
- Server: ``` php artisan serve ``` By default on localhost:8000
- New controller ``` php artisan make:controller {controllerName}Controller ```
- New model ``` php artisan make:model {modelName} -m ``` -m for migration file
- Make DB tables from migration files ``` php artisan migrate ```

Насчёт защиты от SQL-инъекций и XSS не совсем понял как на неё сделать упор. Методы DB::INSERT/UPDATE делаются через mysql PDO, считай само. 
XSS атаки блокируются тегами Blade {{}}. Никакой отдельной работы делать не пришлось или же я не понял задание.

