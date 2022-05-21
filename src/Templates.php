<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloTemplates;

class Templates
{   
    public function __construct(
        public $path,
    ){
        if (!is_dir($path)) {
            throw new \Exception(sprintf("Directory '%s' not found", $path));
        }
    }
    
    public function render(string $fileName, array $data): string
    {
        $filePath = $this->path . DIRECTORY_SEPARATOR . $fileName;
        
        if (!is_file($filePath)) {
            throw new \Exception(sprintf("Template file '%s' not found", $fileName));
        }
        
        extract($data);

        try {
            ob_start();
            include $filePath;
            $content = ob_get_clean();

            return $content;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }
}