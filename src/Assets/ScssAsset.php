<?php
namespace Packaged\Dispatch\Assets;

use Leafo\ScssPhp\Compiler;
use Packaged\Helpers\ValueAs;

class ScssAsset extends AbstractDispatchableAsset
{
  public function getExtension()
  {
    return 'scss';
  }

  public function getContentType()
  {
    return "text/css";
  }

  public function getContent()
  {
    $compiler = new Compiler();

    if($this->_assetManager !== null)
    {
      $compiler->setImportPaths(
        build_path(
          count($this->_assetManager->getRelativePath()) === 0 ?
            $this->_workingDirectory : dirname($this->_workingDirectory),
          build_path_custom(
            DS,
            ValueAs::arr($this->_assetManager->getRelativePath())
          )
        )
      );
    }
    return $compiler->compile(parent::getContent());
  }
}
