<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloTemplates;

class Template
{  
    public $layoutName;
    public $layoutData;

    public function __construct(
        public Engine $engine,
        public string $filePath, 
    ) {
        if (!is_file($this->filePath)) {
            throw new \Exception(sprintf("Template file '%s' not found", $filePath));
        }
    }
    
    public function render(array $data = [])
    {
        extract($data);

        try {
            ob_start();
            include $this->filePath;
            $content = ob_get_clean();
            
            if (isset($this->layoutName)) {
                $layoutData = $this->layoutData;
                $layoutData['content'] = $content;
                $content = $this->engine->render($this->layoutName, $layoutData);
            }

            return $content;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }
    
    public function embedd(string $fileName, array $data = [])
    {
        echo $this->engine->render($fileName, $data);
    }
    
    public function layout(string $name, array $data = [])
    {
        $this->layoutName = $name;
        $this->layoutData = $data;
    }
    
    public function esc($string)
    {
        return htmlspecialchars($string);
    }
}
