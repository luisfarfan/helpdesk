<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ssh_class
 *
 * @author lfarfan
 */
class MY_Controller extends CI_Controller {

    protected $host = "";
    protected $port = 22;
    protected $ssh_user = "";
    protected $ssh_pass = "";
    protected $con;

    public function connect() {
        if (!$this->con = ssh2_connect($this->host, $this->port)) {
            throw new Exception('No se puede conectar con el servidor');
        } else {
            if (!ssh2_auth_password($this->con, $this->ssh_user, $this->ssh_pass)) {
                throw new Exception('Usuario o Contraseña fallidos');
            } else {
                return true;
            }
        }
    }

    public function exec($cmd) {
        if (!($stream = ssh2_exec($this->con, $cmd))) {
            throw new Exception('SSH command failed');
        }
        stream_set_blocking($stream, true);
        $data = "";
        while ($buf = fread($stream, 4096)) {
            $data .= $buf;
        }
        fclose($stream);
//        return $data;
    }

    public function disconnect() {
        $this->exec('echo "EXITING" && exit;');
        $this->connection = null;
    }

}
