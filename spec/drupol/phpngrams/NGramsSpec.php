<?php

namespace spec\drupol\phpngrams;

use drupol\phpngrams\NGrams;
use PhpSpec\ObjectBehavior;

class NGramsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(NGrams::class);
    }

    public function it_can_get_ngram_from_a_string()
    {
        $result = [
            'he',
            'el',
            'll',
            'lo',
        ];

        $this->ngrams('hello', 2)->shouldIterateAs(new \ArrayIterator($result));
    }

    public function it_can_get_ngram_from_a_string_with_big_n()
    {
        $result = [
            'hello',
        ];

        $this->ngrams('hello', 10)->shouldIterateAs(new \ArrayIterator($result));
    }

    public function it_can_get_ngram_from_an_array()
    {
        $result = [
            ['h', 'e'],
            ['e', 'l'],
            ['l', 'l'],
            ['l', 'o'],
        ];

        $this->ngrams(['h', 'e', 'l', 'l', 'o'], 2)->shouldIterateAs(new \ArrayIterator($result));
    }

    public function it_can_get_ngram_from_an_array_without_cycling()
    {
        $result = [
            ['h', 'e', 'l'],
            ['e', 'l', 'l'],
            ['l', 'l', 'o'],
            ['l', 'o', ' '],
            ['o', ' ', 'w'],
            [' ', 'w', 'o'],
            ['w', 'o', 'r'],
            ['o', 'r', 'l'],
            ['r', 'l', 'd'],
        ];

        $this->ngrams(['h', 'e', 'l', 'l', 'o', ' ', 'w', 'o', 'r', 'l', 'd'], 3)->shouldIterateAs(new \ArrayIterator($result));
    }

    public function it_can_get_ngram_from_an_array_with_big_n()
    {
        $result = [
            ['h', 'e', 'l', 'l', 'o'],
        ];

        $this->ngrams(['h', 'e', 'l', 'l', 'o'], 10)->shouldIterateAs(new \ArrayIterator($result));
    }

    public function it_can_calculate_the_frequency()
    {
        $input= 'Hold my beer';
        $ngrams = $this->getWrappedObject()->ngrams($input, 2);
        $this->frequency($ngrams, 'my')->shouldBe(1/11);

        $input= ['h', 'e', 'l', 'l', 'o'];
        $ngrams = $this->getWrappedObject()->ngrams($input, 2);
        $this->frequency($ngrams, ['l', 'l'])->shouldBe(1/4);
    }
}
