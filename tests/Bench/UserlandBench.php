<?php

declare(strict_types=1);

namespace zonuexe;

use PhpBench\Attributes as Bench;
use IntlBreakIterator;
use Budoux\Parser;
use function count;
use function in_array;

#[Bench\Revs(10)]
final class UserlandBench
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
        $parser = Parser::loadDefaultJapaneseParser();
        foreach (range(1, 100) as $_) {
            $result = $parser->parse($phrase);
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
            $parser = Parser::loadDefaultJapaneseParser();
            $result = $parser->parse($phrase);
        }
        assert(in_array(count($result), $expectedLength, true));
    }
}
