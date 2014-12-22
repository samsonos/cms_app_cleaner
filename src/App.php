<?php
namespace samson\cms\cleaner;

use samson\activerecord\Condition;
use samson\activerecord\dbRelation;
/**
 * Generic class for cleaner materials
 * @author Olexandr Nazarenko <nazarenko@samsonos.com>
 * @copyright 2014 SamsonOS
 * @version 0.1
 */
class CleanerApp extends \samson\cms\App
{
    /** @var string Application name */
    public $app_name = 'Очистка';

    /** @var string	Application identifier */
    protected $id = 'cleaner';

    /** @var bool Hide in menu */
    public $hide = true;

    /** Generic controller */
    public function __HANDLER() {
        $this->view('www/view/index')
            ->title('Очистка');
    }

    function __async_clean_draft()
    {
        $output = '<h2>Очистка черновиков</h2>';
        // Get all materials
        if ($db_cmsmats = dbQuery('material')->cond('Draft', 0, dbRelation::NOT_EQUAL)->exec()) {
            foreach ($db_cmsmats as $db_cmsmat) {
                $output .= '<br> Черновик материала ' . $db_cmsmat->id . ' был удален.';
                $db_cmsmat->delete();
            }
            return array('status' => '1', 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_material()
    {
        $output = '<h2>Очистка материалов</h2>';
        // Get all materials
        if ($db_cmsmats = dbQuery('material')->cond('Active', 0)->exec()) {
            foreach ($db_cmsmats as $db_cmsmat) {
                $output .= '<br> Материал ' . $db_cmsmat->id . ' был удален.';
                $db_cmsmat->delete();
            }
            return array('status' => '1', 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_structure()
    {
        $output = '<h2>Очистка структур</h2>';
        // Get all materials
        if ($db_cmsmats = dbQuery('structure')->cond('Active', 0)->exec()) {
            foreach ($db_cmsmats as $db_cmsmat) {
                $output .= '<br> Структура ' . $db_cmsmat->id . ' была удалена.';
                $db_cmsmat->delete();
            }
            return array('status' => '1', 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_field()
    {
        $output = '<h2>Очистка доп. полей</h2>';
        // Get all materials
        if ($db_cmsmats = dbQuery('field')->cond('Active', 0)->exec()) {
            foreach ($db_cmsmats as $db_cmsmat) {
                $output .= '<br> Доп. поле ' . $db_cmsmat->id . ' было удалено.';
                $db_cmsmat->delete();
            }
            return array('status' => '1', 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_materialfield()
    {
        $output = '<h2>Очистка materialfield</h2>';
        $status = '0';
        // Get all materials
        if ($db_materialfields = dbQuery('materialfield')->exec()) {
            foreach ($db_materialfields as $db_materialfield) {
                if ($db_materialfield->Active == 0) {
                    $output .= '<br> Materialfield поле ' . $db_materialfield->id . ' было удалено.';
                    $db_materialfield->delete();
                    $status = '1';
                } elseif (!dbQuery('material')->cond('MaterialID', $db_materialfield->MaterialID)->exec()) {
                    $output .= '<br> Materialfield поле ' . $db_materialfield->id . ' было удалено.';
                    $db_materialfield->delete();
                    $status = '1';
                } elseif (!dbQuery('field')->cond('FieldID', $db_materialfield->FieldID)->exec()) {
                    $output .= '<br> Materialfield поле ' . $db_materialfield->id . ' было удалено.';
                    $db_materialfield->delete();
                    $status = '1';
                }
            }
            return array('status' => $status, 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_structurefield()
    {
        $output = '<h2>Очистка structurefield</h2>';
        $status = '0';
        // Get all materials
        if ($db_structurefields = dbQuery('structurefield')->exec()) {
            foreach ($db_structurefields as $db_structurefield) {
                if ($db_structurefield->Active == 0) {
                    $output .= '<br> Structurefield поле ' . $db_structurefield->id . ' было удалено.';
                    $db_structurefield->delete();
                    $status = '1';
                } elseif (!dbQuery('structure')->cond('StructureID', $db_structurefield->StructureID)->exec()) {
                    $output .= '<br> Structurefield поле ' . $db_structurefield->id . ' было удалено.';
                    $db_structurefield->delete();
                    $status = '1';
                } elseif (!dbQuery('field')->cond('FieldID', $db_structurefield->FieldID)->exec()) {
                    $output .= '<br> Structurefield поле ' . $db_structurefield->id . ' было удалено.';
                    $db_structurefield->delete();
                    $status = '1';
                }
            }
            return array('status' => $status, 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }

    function __async_clean_gallery()
    {
        // Получим путь к файлам галлереи
        //$gallery_folder_path = __SAMSON_CWD__.'upload';

        // Получим файлы из галлереи
        //$files = glob($gallery_folder_path.'/*');

        $output = '<h2>Очистка галереи</h2>';
        $status = '0';
        // Get all materials
        if ($db_gallery = dbQuery('gallery')->exec()) {
            foreach ($db_gallery as $db_img) {
                // Построим полный путь к картинке
                //$img_path = __SAMSON_CWD__.$db_img->Src;
                if ($db_img->Active == 0 /* || !in_array($img_path, $files)*/) {
                    $output .= '<br> Изображение ' . $db_img->id . ' было удалено.';
                    $db_img->delete();
                    $status = '1';
                }
            }
            return array('status' => $status, 'html' => $output);
        } else {
            return array('status' => '0', 'html' => $output);
        }
    }
}


