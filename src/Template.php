<?php
declare(strict_types=1);

namespace WymarzonyLogin\TrogloTemplates;

class Template
{   
    public function render(string $path, array $data): string
    {
        return $path;
    }
}