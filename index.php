<?php
 
// https://gist.github.com/magnetikonline/650e30e485c0f91f2f40
 
	 
class DumpHTTPRequestToFile {

	public function execute($targetFile) {

		$data = sprintf(
			"%s %s %s\n\nHTTP headers:\n",
			$_SERVER['REQUEST_METHOD'],
			$_SERVER['REQUEST_URI'],
			$_SERVER['SERVER_PROTOCOL']
		);

		foreach ($this->getHeaderList() as $name => $value) {
			$data .= $name . ': ' . $value . "\n";
		}
		$json  =file_get_contents('php://input');
		 #$mysqli = new mysqli("localhost","wivach","BananaLavender14","pm_data");
        #$mysqli = new mysqli("10.103.2.30","root","FYYggx71351","pm_data");
        $mysqli = new mysqli("10.100.2.66","root","MYKqoe97122","pm_data");
		$mysqli -> set_charset("utf8");
		$sql = "INSERT INTO `pmdata` (`s_data`) VALUES ('".$json."')";
		$mysqli ->query($sql);
		$data .= "\nRequest body:\n";
	
		#file_put_contents(
			#$targetFile,
			#$data . $json . "\n", FILE_APPEND
		#);
		 
		echo("Done!\n\n");
		header('HTTP/1.1 200 OK');
	}

	private function getHeaderList() {

		$headerList = [];
		foreach ($_SERVER as $name => $value) {
			if (preg_match('/^HTTP_/',$name)) {
				// convert HTTP_HEADER_NAME to Header-Name
				$name = strtr(substr($name,5),'_',' ');
				$name = ucwords(strtolower($name));
				$name = strtr($name,' ','-');

				// add to list
				$headerList[$name] = $value;
			}
		}

		return $headerList;
	}
}


(new DumpHTTPRequestToFile)->execute('./dumprequest.txt');