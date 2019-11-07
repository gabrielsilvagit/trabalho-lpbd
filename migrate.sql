
   Illuminate\Database\QueryException  : SQLSTATE[HY000] [1045] Access denied for user 'forge'@'localhost' (using password: NO) (SQL: select * from information_schema.tables where table_schema = forge and table_name = migrations and table_type = 'BASE TABLE')

  at C:\Gabriel\estudos\trabalho\vendor\laravel\framework\src\Illuminate\Database\Connection.php:665
    661|         // If an exception occurs when attempting to run a query, we'll format the error
    662|         // message to include the bindings with SQL, which will make this exception a
    663|         // lot more helpful to the developer instead of just the database's errors.
    664|         catch (Exception $e) {
  > 665|             throw new QueryException(
    666|                 $query, $this->prepareBindings($bindings), $e
    667|             );
    668|         }
    669|

  Exception trace:

  1   PDOException::("SQLSTATE[HY000] [1045] Access denied for user 'forge'@'localhost' (using password: NO)")
      C:\Gabriel\estudos\trabalho\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70

  2   PDO::__construct("mysql:host=127.0.0.1;port=3306;dbname=forge", "forge", "", [])
      C:\Gabriel\estudos\trabalho\vendor\laravel\framework\src\Illuminate\Database\Connectors\Connector.php:70

  Please use the argument -v to see more details.
