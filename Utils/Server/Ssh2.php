<?php
/** 
 * @author Web Design Rosario
 * @version Feb 20 2012
 */

class Ssh2 {

	private $host = null;
	private $port = '22';
	private $connection = null;
	private $user = null;
	private $password = null;
	private $auth = null;
	private $sftp = null;
	private $shellType = 'vt101';
	private $shell = null;

	/** 
	 * Tries to performs the SSH connection
	 * 
	 * @param	string	$host
	 * @param	string	$port
	 */
	public function __construct($host, $port=null) {
		$this->host = $host;
		if(!empty($port)){
			$this->port = $port;
		}
		if(empty($this->host)){
			throw new Exception('Host can not be null');
		}
		$this->connection = ssh2_connect($this->host, $this->port);
		if(empty($this->connection)) {
			throw new Exception('Can not connected to '.$this->host.':'.$this->port);
		}
	}

	/** 
	 * Tries to authenticate the user
	 * 
	 * @param	string	$user
	 * @param	string	$password
	 * @return	bool
	 */
	public function auth($user, $password) {
		$this->user = $user;
		$this->password = $password;
		if(empty($this->user) || empty($this->password)){
			throw new Exception('User and password can not be null');
		}
		$this->auth = ssh2_auth_password($this->connection, $this->user, $this->password);
		if(empty($this->auth)) {
			throw new Exception('Authentication failed!');
		}
		return true;
	}

	/** 
	 * Execute a command on a remote server
	 * Expects a variable
	 * 
	 * @param	string	$command
	 * @return	Array|string
	 * @see		http://www.php.net/manual/en/function.ssh2-exec.php
	 * @see		http://www.php.net/manual/en/function.func-get-args.php
	 */
	public function exec() {
		$argumentList = func_get_args();
		foreach($argumentList as $arg){
			if(!is_string($arg)){
				throw new Exception('Unexpected non string arguments');
			}
		}
		$cmd = implode(" &amp;&amp; ", $argumentList);
		$stream = ssh2_exec($this->connection, $cmd);
		stream_set_blocking($stream, true);
		$output = array(
				'output'=>stream_get_contents($stream),
				'errors'=>stream_get_contents(ssh2_fetch_stream($stream, SSH2_STREAM_STDERR))
			);
		return $output;
	}

	/** 
	 * Creates a remote folder via SFTP. If folder already exists it fails.
	 * 
	 * @param	string	$dirPath
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-sftp-mkdir.php
	 */
	public function createDir($dirPath) {
		if(empty($this->sftp)){
			$this->sftp = ssh2_sftp($this->connection);
		}
		$success = ssh2_sftp_mkdir($this->sftp, $dirPath);
		if(!$success){
			throw new Exception('Can not create folder: ' . $dirPath);
		}
		return true;
	}

	/** 
	 * Removes a remote folder via SFTP
	 * 
	 * @param	string	$dirPath
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-sftp-rmdir.php
	 */
	public function removeDir($dirPath) {
		if(empty($this->sftp)){
			$this->sftp = ssh2_sftp($this->connection);
		}
		$success = ssh2_sftp_rmdir($this->sftp, $dirPath);
		if(!$success){
			throw new Exception('Can not remove folder: ' . $dirPath);
		}
		return true;
	}

	/** 
	 * Sends a file via SCP. If file already exists it will be overwrited
	 * 
	 * @param	string	$localFile
	 * @param	string	$remoteFile
	 * @param	int		$permision
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-scp-send.php
	 */
	public function uploadFile($localFile,$remoteFile,$permision) {
		if(file_exists($localFile)){
			$success = ssh2_scp_send($this->connection, $localFile, $remoteFile, $permision);
			if (!$success) {
				throw new Exception('Can not transfer file: ' . $localFile);
			}
			return true;
		} else {
			throw new Exception($localFile . ' not exist');
		}
	}

	/** 
	 * Gets a file via SCP
	 * 
	 * @param	string	$remoteFile
	 * @param	string	$localFile
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-scp-recv.php
	 */
	public function downloadFile($remoteFile, $localFile) {
		$success = ssh2_scp_recv($this->connection, $remoteFile, $localFile);
		if (!$success) {
			throw new Exception('Can not receive file: ' . $localFile);
		}
		return true;
	}

	/** 
	 * Renames a remote file via SFTP
	 * 
	 * @param	string	$oldFilePath
	 * @param	string	$newFilePath
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-sftp-rename.php
	 */
	public function rename($oldFilePath, $newFilePath) {
		if(empty($this->sftp)){
			$this->sftp = ssh2_sftp($this->connection);
		}
		$success = ssh2_sftp_rename($this->sftp, $oldFilePath, $newFilePath);
		if(!$success){
			throw new Exception('Can not rename file: ' . $oldFilePath);
		}
		return true;
	}

	/** 
	 * Deletes a remote file via SFTP
	 * 
	 * @param	string	$filePath
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-sftp-unlink.php
	 */
	public function removeFile($filePath) {
		if(empty($this->sftp)){
			$this->sftp = ssh2_sftp($this->connection);
		}
		$success = ssh2_sftp_unlink($this->sftp, $filePath);
		if(!$success){
			throw new Exception('Can not remove file: ' . $filePath);
		}
		return true;
	}

	/** 
	 * Request an interactive shell
	 * 
	 * @param	string	$shellType
	 * @return	bool
	 * @see		http://www.php.net/manual/en/function.ssh2-shell.php
	 * @see		http://manpages.ubuntu.com/manpages/oneiric/es/man5/termcap.5.html
	 * @deprecated
	 */
	public function openShell($shellType=null) {
		if (!empty($shellType)){
			$this->shellType = $shellType;
		}
		$this->shell = ssh2_shell($this->connection, $this->shellType);
		if(empty($this->shell)){
			throw new Exception('Shell connection failed!');
		}
		return true;
	}

	/** 
	 * Write commands into the current shell
	 * Warning: Once openShell method is used, exec does not work
	 *
	 * @param	string	$command
	 * @return	bool
	 * @deprecated
	 */
	public function writeShell($command) {
		if(empty($this->shell)){
			throw new Exception('Can not write in a non opened shell');
		}
		if(!empty($command) && is_string($command)){
			fwrite($this->shell, $command."\n");
			return true;
		}
		return false;
	}

	/** 
	 * Write commands into the current shell
	 * 
	 * @param	string	$command
	 * @deprecated
	 */
	public function disconnect() {
		if (function_exists('ssh2_disconnect')) {
			ssh2_disconnect($this->connection);
		} else {
			unset($this->conn);
		}
	}
}