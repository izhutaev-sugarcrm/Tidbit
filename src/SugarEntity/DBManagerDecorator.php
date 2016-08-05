<?php

namespace Sugarcrm\Tidbit\SugarEntity;

/**
 * Class DBManagerDecorator
 *
 * Encapsulate Sugar DBManager class calls and logic in one place,
 * so Tidbit can use decorator class instead of knowing about Sugar class inself
 *
 * @package Sugarcrm\Tidbit\SugarEntiry
 */
class DBManagerDecorator
{
    /** @var \DBManager Sugar DBManager class */
    protected $db;

    public function __construct(\DBManager $db)
    {
        $this->db = $db;
    }

    /**
     * Get truncate table statement for different db types
     *
     * @param string $tableName
     * @return string
     */
    public function truncateTableSQL($tableName)
    {
        return ($this->db->dbType == 'ibm_db2')
            ? sprintf('ALTER TABLE %s ACTIVATE NOT LOGGED INITIALLY WITH EMPTY TABLE', $tableName)
            : $this->db->truncateTableSQL($tableName);
    }
}
