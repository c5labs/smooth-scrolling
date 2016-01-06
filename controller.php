<?php
namespace Concrete\Package\ConcreteSmoothScrolling;

use Concrete\Core\Asset\Asset;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Http\ResponseAssetGroup;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Events;
use Package;

defined('C5_EXECUTE') or die("Access Denied.");

/**
 * Package adding hero block type.
 * 
 * @author Oliver Green <dubious@codeblog.co.uk>
 * @link http://www.codeblog.co.uk
 * @license http://www.gnu.org/licenses/gpl.html GPLs
 */
class Controller extends Package
{
    /**
     * Package handle.
     *
     * @var string
     */
    protected $pkgHandle = 'concrete-smooth-scrolling';

    /**
     * Minimum concrete5 version.
     *
     * @var string
     */
    protected $appVersionRequired = '5.7.1';

    /**
     * Package version.
     *
     * @var string
     */
    protected $pkgVersion = '0.9.0';

    /**
     * On CMS boot.
     *
     * @return void
     */
    public function on_start()
    {
        $this->registerAssets();

        Events::addListener('on_before_render', function ($e) {
            $c = Page::getCurrentPage();

            $r = ResponseAssetGroup::get();

            if (!$c->isEditMode()) {
                $r->requireAsset('smooth-scrolling');
            }
        });
    }

    /**
     * Get the package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return t("Smooth Scrolling Components");
    }

    /**
     * Get the package description.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return t("Package adding smooth scrolling to your site.");
    }

    /**
     * Install routine.
     *
     * @return \Concrete\Core\Package\Package
     */
    public function install()
    {
        $pkg = parent::install();

        return $pkg;
    }

    /**
     * Removal routine.
     *
     * @return void
     */
    public function uninstall()
    {
        parent::uninstall();
    }

    /**
     * Register the assets that the package provides.
     *
     * @return void
     */
    protected function registerAssets()
    {
        // Items must go in the header to prevent 'twitches' onload. 
        $al = AssetList::getInstance();

        /*
         * Nice Scroll
         */
        $al->register(
            'javascript', 'jquery-nicescroll/js', 'assets/jquery.nicescroll/dist/jquery.nicescroll.min.js',
            array(
                'version' => '3.6.6', 'position' => Asset::ASSET_POSITION_HEADER,
                'minify' => true, 'combine' => true
            ), $this
        );

        /*
         * Bootstraper
         */
        $al->register(
            'javascript', 'jquery-nicescroll/bootstraper', 'assets/smooth-scrolling.js',
            array(
                'version' => '0.9.0', 'position' => Asset::ASSET_POSITION_HEADER,
                'minify' => true, 'combine' => true
            ), $this
        );

        $al->registerGroup(
            'smooth-scrolling',
            array(
                array('javascript', 'jquery-nicescroll/js'),
                array('javascript', 'jquery-nicescroll/bootstraper'),
            )
        );
    }
}
