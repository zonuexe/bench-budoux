<?php

declare(strict_types=1);

namespace zonuexe;

trait PhraseProvider
{
    public function provide()
    {
        yield '短文' => [[6, 8], 'BudouX: 読みやすい改行のための軽量な分かち書き器'];
    }
}
