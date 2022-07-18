<?php

namespace App\Games\Lotto\Contracts;

interface ITypeGameCategory
{
    public function getViewName();
    public function renderHtml();
    public function toJson();
}
