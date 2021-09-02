<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// Require the abstract plugin class
require_once COM_FABRIK_FRONTEND . '/models/plugin-list.php';

class PlgFabrik_ListChange_value extends PlgFabrik_List
{
    private $tableName;
    private $extractToField;

    public function button(&$args)
    {
        $model           = $this->getModel();
        $params          = $this->getParams();
        $elementPlugin   = FabrikWorker::getPluginManager();
        $this->tableName = $model->getTable()->db_table_name;

        $typeCase      = $params->get('transform_case');
        $elementIdCase = $params->get('list_case_elements');

        $checkNull       = $params->get('value_null');
        $comparison      = $params->get('comparison');
        $allRecords      = $params->get('all_records');
        $new             = $params->get('value_update');
        $current         = $params->get('value_current');
        $elementIdValues = $params->get('list_values_elements');

        if ($typeCase != null && $elementIdCase != null) {
            $this->extractToField = $elementPlugin->getElementPlugin($elementIdCase)->element->name;

            $rows = $this->getData();

            foreach ($rows as $row) {
                $elementName = $this->extractToField;            
                $newElement = $this->changeCase($typeCase, $row->$elementName);
    
                if ($newElement !== $row->$elementName) {
                    $this->updateCase($row->id, $newElement);
                }
            }
        }

        if ($elementIdValues != null) 
        {
            $this->extractToField = $elementPlugin->getElementPlugin($elementIdValues)->element->name;

            $newValue = ($checkNull) ? 'null' : $new;
    
            if ($allRecords) {
                $this->updateValues($newValue);
            } else {
                $current = (is_null($current)) ? "" : $current;
                $this->updateValues($newValue, $current, $comparison);
            }
        }

        return false;    
    }

    protected function getData() {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select(array('id', $this->extractToField))->from($this->tableName);
        $db->setQuery($query);

        return $db->loadObjectList();
    }

    protected function changeCase($type, $case) {
        $encoding = 'UTF-8';

        if ($type == 0) {
            return mb_strtoupper($case, $encoding);
        } elseif ($type == 1) {
            return mb_strtolower($case, $encoding);
        } elseif ($type == 2) {
            return ucfirst($case);
        } elseif ($type == 3) {
            return ucwords($case);
        }
    }

    protected function updateCase($rowId, $text) {
        if (!$this->extractToField) {
            return false;
        }

        $field = $this->extractToField;

        $row         = new stdClass();
        $row->id     = $rowId;
        $row->$field = $text;

        return JFactory::getDbo()->updateObject($this->tableName, $row, 'id');
    }

    protected function updateValues($value, $where = null, $comparison = null) {
        if (!$this->extractToField) {
            return false;
        }
        
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $value = ($value != 'null') ? $db->quote($value) : $value;

        $query
            ->update($db->quoteName($this->tableName))
            ->set($db->quoteName($this->extractToField) . ' = ' . $value);
        
        if ($where !== null) {
            if ($comparison == 'like') {
                $query->where($db->quoteName($this->extractToField) . " like '%" . $where . "%'");
            } else {
                if ($where == "") {
                    $query->where($db->quoteName($this->extractToField) . " = ''");
                    $query->orWhere($db->quoteName($this->extractToField) . ' is null');
                } else if(strcasecmp($where, 'null') == 0) {
                    $query->where($db->quoteName($this->extractToField) . ' = ' . $db->quote($where));
                } else {
                    $query->where($db->quoteName($this->extractToField) . ' = ' . $where);
                }
            }            
        }

        $db->setQuery($query);

        return $db->execute();
    }
}
