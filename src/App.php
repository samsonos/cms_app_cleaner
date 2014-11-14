<?php
namespace samson\cms\cleaner;
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

    /** Generic controller */
    public function __HANDLER()
    {
        $this->view('www/index')
            ->title('Очистка');
    }

}

