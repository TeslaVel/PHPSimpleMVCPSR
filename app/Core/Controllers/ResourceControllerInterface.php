<?php

namespace App\Core\Controllers;

interface ResourceControllerInterface
{
    public function index();
    public function show($id);
    public function edit($id);
    public function update($id);
    public function delete($id);
}