<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * DB Controller
 *
 *
 * @method \App\Model\Entity\DB[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DBController extends AppController
{
    public function clear()
    {
        $this->autoRender = false;
        $con = ConnectionManager::get('default');
        $tables = $con->schemaCollection()->listTables();
        $previous_table_statuses = [];
        $table_statuses = [];
        foreach ($tables as $table){
            $previous_table_statuses[] =[
                'table' => $table,
                'rows' => $con->execute("SELECT * FROM ". $table)->count()
            ];
            $stmt = $con->execute("TRUNCATE TABLE ".$table);

            $table_statuses[] =[
                'table' => $table,
                'rows' => $con->execute("SELECT * FROM ". $table)->count()
            ];
        }

        pr($previous_table_statuses);

        pr($table_statuses);
        $this->request->getSession()->destroy();
        die();
    }
}
