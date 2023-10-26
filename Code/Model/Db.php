<?php
namespace Model;

use PDO;

class Db
{
    static $db = null;

    static function Connect()
    {
        if (is_null(self::$db)) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            try {
                self::$db = new PDO($dsn, DB_USER, DB_PASSWORD);
                self::$db->exec("SET NAMES 'UTF8'");
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
    public function __construct()
    {
        self::Connect();
    }

    protected function _Create(string $sql, array $datas)
    {
        $rq = self::$db->prepare($sql);
        $rq->execute($datas);
        return self::$db->lastInsertId();
    }

    protected function _Find($sql)
    {
        $rq = self::$db->prepare($sql);
        $rq->execute();
        return $rq->fetchAll();
    }

    protected function _FindOne($sql, $datas)
    {
        $rq = self::$db->prepare($sql);
        $rq->execute($datas);
        return $rq->fetch();
    }

    protected function _Execute($sql, $datas)
    {
        $rq = self::$db->prepare($sql);
        return $rq->execute($datas);
    }

    protected function _ExecuteAndFetchAll($sql, $datas)
    {
        $rq = self::$db->prepare($sql);
        $rq->execute($datas);
        return $rq->fetchAll();
    }

}

?>