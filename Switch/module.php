<?php

require_once __DIR__ . '/../libs/pjlink.class.php';

class Switch extends IPSModule {

    public function Create() {
        parent::Create();
        $this->RegisterPropertyString("Host", "");
        $this->RegisterPropertyString("Port", "");
    }

    public function ApplyChanges() {
        parent::ApplyChanges();
        if ($this->ReadPropertyString("Host") != "") {
            $this->SetStatus(102);
        } else {
            $this->SetStatus(104);
        }

        $this->MaintainVariable("Status", "Status", 3, "TextBox", 0, true);
        $this->GetName();
    }

    public function GetName() {
        $pjlink = new PJLink(2);
        $pjlink->setDevice("192.168.0.152", "", 10, 53484);
        $name = $pjlink->getName();
        SetValue($this->GetIDForIdent("Status"),$name);
        $this->SendDebug("PJ Response", $name, 0);
    }

//    public function SwitchOn() {
//        if ($this->ReadPropertyBoolean("EnclosureNeopixel")) {
//            $url = $this->ReadPropertyString("Scheme") . '://' . $this->ReadPropertyString("Host");
//            $this->httpGet($url . "/plugin/enclosure/setNeopixel?index_id=2&red=255&green=255&blue=255");
//        }
//    }

}