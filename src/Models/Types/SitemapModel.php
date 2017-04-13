<?php namespace Vis\SitemapGenerator;

class SitemapModel extends AbstractSitemapObject
{

    protected $model;

    protected $lastmod_field    = "updated_at";
    protected $url_method       = "getUrl";
    protected $is_active_field  = 'is_active';
    protected $additional_where = [];

    /**
     * @param string $key
     * @return $this
     */
    protected function setKey($key)
    {
        $this->model = $key;
        return $this;
    }

    /**
     * @param string $link
     * @return $this
     */
    protected function setUrl($link)
    {
        $field = $this->url_method;
        $this->url = $field ? $link->$field() : "/" ;

        return $this;
    }

    /**
     * @param string $link
     * @return $this
     */
    protected function setLastmod($link)
    {
        $field = $this->lastmod_field;
        $this->lastmod = $field ? $link->$field : "";

        return $this;
    }

    /**
     * @return array
     */
    protected function getAdditionalWhere()
    {
        return $this->additional_where;
    }

    /**
     * @return string
     */
    protected function getIsActiveField()
    {
        return $this->is_active_field;
    }

    /**
     * @return string
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    //fixme links array? wtf.
    public function getLinksArray()
    {
        $links = [];

        $this->model = new $this->model;

        if($this->getIsActiveField()){
            $this->model = $this->model->where($this->getIsActiveField(), "=", 1);
        }

        foreach ($this->getAdditionalWhere() as $fieldName => $condition) {
            $this->model = $this->model->where($fieldName, $condition['sign'], $condition['value']);
        }

        $entities = $this->model->get();

        foreach($entities as $key => $link){
            $links[] = $this->setUrl($link)->setLastmod($link)->convertToArray();
        }

        return $links;
    }

}