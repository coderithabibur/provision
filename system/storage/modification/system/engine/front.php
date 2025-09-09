<?php
final class Front {
	private $registry;
	private $pre_action = array();
	private $error;

	public function __construct($registry) {
		$this->registry = $registry;
	}

	public function addPreAction($pre_action) {
		$this->pre_action[] = $pre_action;
	}

	public function dispatch($action, $error) {
		$this->error = $error;

		foreach ($this->pre_action as $pre_action) {
			$result = $this->execute($pre_action);

			if ($result) {
				$action = $result;

				break;
			}
		}


                // START: NitroPack.io (https://nitropack.io)
                if (basename(DIR_APPLICATION) == "catalog" && is_file(DIR_CONFIG . 'nitropackio/compatibility.php')) {
                    $this->registry->get('config')->load('nitropackio/compatibility');

                    $nitro_config = $this->registry->get('config')->get('nitropackio');

                    $nitro_action = new \Action($nitro_config['route']['module']['nitropack'] . '/postSeoUrl');

                    $nitro_action->execute($this->registry);
                }
                // END: NitroPack.io (https://nitropack.io)
            
		while ($action) {
			$action = $this->execute($action);
		}
	}

	private function execute($action) {
		$result = $action->execute($this->registry);

		if (is_object($result)) {
			$action = $result;
		} elseif ($result === false) {
			$action = $this->error;

			$this->error = '';
		} else {
			$action = false;
		}

		return $action;
	}
}