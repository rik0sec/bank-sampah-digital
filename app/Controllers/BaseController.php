<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = ['url', 'form', 'text'];
    protected $session;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
    }

    protected function isLoggedIn(): bool
    {
        return $this->session->has('logged_in');
    }

    protected function getRole(): string
    {
        return $this->session->get('role') ?? '';
    }

    protected function render(string $view, array $data = []): string
    {
        $data['session'] = $this->session;
        return view('templates/header', $data)
             . view('templates/sidebar', $data)
             . view($view, $data)
             . view('templates/footer', $data);
    }
}