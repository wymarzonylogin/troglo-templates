<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloTemplates;

class Engine
{   
    public function __construct(
        public $path,
    ){
        if (!is_dir($path)) {
            throw new \Exception(sprintf("Directory '%s' not found", $path));
        }
    }
    
    public function render(string $fileName, array $data = []): string
    {
        $filePath = $this->path . DIRECTORY_SEPARATOR . $fileName;
        $template =  new Template($this, $filePath);
        
        return $template->render($data);
    }
}