<?php

declare(strict_types=1);

namespace zonuexe;

use PhpBench\Attributes as Bench;
use IntlBreakIterator;
use IntlRuleBasedBreakIterator;
use function count;
use function in_array;
use function iterator_to_array;

#[Bench\Revs(10)]
final class IntlBench
{
    use PhraseProvider;

    /**
     * @param array{string} $param
     */
    #[Bench\Warmup(2)]
    #[Bench\ParamProviders(['provide'])]
    public function bench($param): void
    {
        [$expectedLength, $phrase] = $param;
        $gen = IntlBreakIterator:: createLineInstance('ja-u-lw-phrase');
        foreach (range(1, 100) as $_) {
            $gen->setText($phrase);
            $result = iterator_to_array($gen->getPartsIterator());
        }
        assert(in_array(count($result), $expectedLength, true));
    }

    /**
     * @param array{string} $param
     */
    #[Bench\Warmup(2)]
    #[Bench\ParamProviders(['provide'])]
    public function benchInitializeByParse($param): void
    {
        [$expectedLength, $phrase] = $param;
        foreach (range(1, 100) as $_) {
            $gen = IntlBreakIterator:: createLineInstance('ja-u-lw-phrase');
            $gen->setText($phrase);
            $result = iterator_to_array($gen->getPartsIterator());
        }
        assert(in_array(count($result), $expectedLength, true));
    }
}
