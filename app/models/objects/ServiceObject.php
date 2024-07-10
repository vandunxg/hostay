<?php
class ServiceObject{
    private $service_id;
    private $service_name;
    private $service_description;
    private $service_price;
    private $service_created_at;



    /**
     * Get the value of service_id
     */
    public function getServiceId() {
        return $this->service_id;
    }

    /**
     * Set the value of service_id
     */
    public function setServiceId($service_id): self {
        $this->service_id = $service_id;
        return $this;
    }

    /**
     * Get the value of service_name
     */
    public function getServiceName() {
        return $this->service_name;
    }

    /**
     * Set the value of service_name
     */
    public function setServiceName($service_name): self {
        $this->service_name = $service_name;
        return $this;
    }

    /**
     * Get the value of service_description
     */
    public function getServiceDescription() {
        return $this->service_description;
    }

    /**
     * Set the value of service_description
     */
    public function setServiceDescription($service_description): self {
        $this->service_description = $service_description;
        return $this;
    }

    /**
     * Get the value of service_price
     */
    public function getServicePrice() {
        return $this->service_price;
    }

    /**
     * Set the value of service_price
     */
    public function setServicePrice($service_price): self {
        $this->service_price = $service_price;
        return $this;
    }

    /**
     * Get the value of service_created_at
     */
    public function getServiceCreatedAt() {
        return $this->service_created_at;
    }

    /**
     * Set the value of service_created_at
     */
    public function setServiceCreatedAt($service_created_at): self {
        $this->service_created_at = $service_created_at;
        return $this;
    }
}