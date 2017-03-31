<?php

namespace xltxlm\ormTool\Config;

use \xltxlm\ormTool\Unit\FieldSchema;

final class ShakealertType
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
    public static function dtvalueIsInt() :bool
    {
        return in_array('date' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function dtvalueIsFloat() :bool
    {
        return in_array('date' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function dtvalueIsString() :bool
    {
        return in_array('date' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function dtvalueIsDate() :bool
    {
        return in_array('date' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function dtvalueIsTime() :bool
    {
        return in_array('date' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function dtvalueIsEnum() :bool
    {
        return in_array('date' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function dtfieldnameIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function dtfieldnameIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function dtfieldnameIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function dtfieldnameIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function dtfieldnameIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function dtfieldnameIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function tablenameIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function tablenameIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function tablenameIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function tablenameIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function tablenameIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function tablenameIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function conditionIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function conditionIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function conditionIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function conditionIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function conditionIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function conditionIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldnameIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldnameIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldnameIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldnameIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldnameIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldnameIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldname1dayIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldname1dayIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldname1dayratioIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayratioIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayratioIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayratioIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldname1dayratioIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldname1dayratioIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldname1weekIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldname1weekIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldname1weekratioIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekratioIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekratioIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekratioIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldname1weekratioIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldname1weekratioIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function fieldnamenewIsInt() :bool
    {
        return in_array('varchar' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function fieldnamenewIsFloat() :bool
    {
        return in_array('varchar' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function fieldnamenewIsString() :bool
    {
        return in_array('varchar' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function fieldnamenewIsDate() :bool
    {
        return in_array('varchar' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function fieldnamenewIsTime() :bool
    {
        return in_array('varchar' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function fieldnamenewIsEnum() :bool
    {
        return in_array('varchar' , [FieldSchema::ENUM]);
    }


    /**
     * @return bool
    */
    public static function add_timeIsInt() :bool
    {
        return in_array('timestamp' , [FieldSchema::INT,FieldSchema::BIGINT,FieldSchema::TINYINT]);
    }

    /**
     * @return bool
    */
    public static function add_timeIsFloat() :bool
    {
        return in_array('timestamp' , [FieldSchema::FLOAT,FieldSchema::DECIMAL]);
    }

    /**
     * @return bool
    */
    public static function add_timeIsString() :bool
    {
        return in_array('timestamp' , [FieldSchema::TEXT,FieldSchema::VARCHAR,FieldSchema::LONGTEXT,FieldSchema::MEDIUMTEXT]);
    }

    /**
     * @return bool
    */
    public static function add_timeIsDate() :bool
    {
        return in_array('timestamp' , [FieldSchema::DATE,FieldSchema::TIMESTAMP,FieldSchema::DATETIME]);
    }
    /**
     * @return bool
    */
    public static function add_timeIsTime() :bool
    {
        return in_array('timestamp' , [FieldSchema::TIME]);
    }

    /**
     * @return bool
    */
    public static function add_timeIsEnum() :bool
    {
        return in_array('timestamp' , [FieldSchema::ENUM]);
    }


}