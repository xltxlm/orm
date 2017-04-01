<?php

namespace xltxlm\ormTool\Config;

use \xltxlm\ormTool\Unit\FieldSchema;

final class Service_dataType
{
    /**
     * @return bool
    */
    public static function idIsInt() :bool
    {
        return in_array('int' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function idIsFloat() :bool
    {
        return in_array('int' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function idIsString() :bool
    {
        return in_array('int' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function idIsDate() :bool
    {
        return in_array('int' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function idIsTime() :bool
    {
        return in_array('int' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function idIsEnum() :bool
    {
        return in_array('int' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function dtIsInt() :bool
    {
        return in_array('date' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function dtIsFloat() :bool
    {
        return in_array('date' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function dtIsString() :bool
    {
        return in_array('date' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function dtIsDate() :bool
    {
        return in_array('date' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function dtIsTime() :bool
    {
        return in_array('date' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function dtIsEnum() :bool
    {
        return in_array('date' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function servicenameIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function servicenameIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function servicenameIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function servicenameIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function servicenameIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function servicenameIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function processIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function processIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function processIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function processIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function processIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function processIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function numIsInt() :bool
    {
        return in_array('int' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function numIsFloat() :bool
    {
        return in_array('int' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function numIsString() :bool
    {
        return in_array('int' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function numIsDate() :bool
    {
        return in_array('int' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function numIsTime() :bool
    {
        return in_array('int' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function numIsEnum() :bool
    {
        return in_array('int' , [FieldSchema::ENUM]);
    }


}