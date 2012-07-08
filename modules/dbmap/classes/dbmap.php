<?php

class DBmap {

    public static function get_table_names() {
        $db = DatabaseQuery::connection();
        $tables = $db->query('SHOW TABLES IN `' . db_name . '`;');

        $tables_and_properties = array();

        foreach ($tables as $t) {
            $properties = $db->query('SHOW COLUMNS FROM `' . $t['Tables_in_' . db_name] . '` FROM `' . db_name . '`;');
            $tables_and_properties[$t['Tables_in_' . db_name]] = $properties;
        }

        return $tables_and_properties;
    }

    public static function map() {
        $tables = self::get_table_names();

        foreach ($tables as $table_name => $properties) {
            self::create_class($table_name, $properties);
            //verificar necessidade
            //require_once root . "core/orm/$table_name.php";
        }
    }

    public static function create_class($table_name, $properties = array()) {
        $contents = file_get_contents(modpath . 'dbmap/classes/templates/model.template');

        $file_name = $table_name;
        $file_name[0] = strtolower($file_name[0]);
        
        if (is_file(root . "app/models/$file_name.php") && !dbmap_force) {
            return;
        }
        
        $modules = Modules::instance();
        foreach ($modules as $path) {
            if (is_file($path . "models/$file_name.php") && !dbmap_force) {
                return;
            }
        }
        

        $class_name = $table_name;
        $class_name[0] = strtoupper($class_name[0]);

        $contents = str_replace(':class_name', $class_name, $contents);
        $contents = str_replace(':table_name', $table_name, $contents);

        $properties_str = self::_create_properties($properties);

        $contents = str_replace(':properties', $properties_str, $contents);
        file_put_contents(root . "app/models/$file_name.php", $contents);
    }
    
    private static function _create_properties($properties){
        $properties_str = '';
        if (count($properties)) {
            foreach ($properties as $p) {
                if ($p['Key'] == 'PRI') {
                    $p_template = file_get_contents(modpath . 'dbmap/classes/templates/id.template');
                    $p_template = str_replace(':auto_increment', preg_match('@auto_increment@', $p['Extra']) == -1 ? '' : '@AutoGenerate()', $p_template);
                } else {
                    $p_template = file_get_contents(modpath . 'dbmap/classes/templates/properties.template');
                }

                $p_template = str_replace(':column_type', $p['Type'], $p_template);
                $properties_str .= str_replace(':column_name', $p['Field'], $p_template);
            }
        }
        
        return $properties_str;
    }

}