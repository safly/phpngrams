<?php

namespace drupol\phpngrams;

class NGrams extends AbstractNGrams
{
    /**
     * @param $data
     * @param $n
     *
     * @return bool|\Generator
     */
    public function ngrams($data, $n)
    {
        return $this->ngramsFactory($data, $n, false);
    }
}
