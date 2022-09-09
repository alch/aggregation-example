<?php

namespace App\Modules\Product\Infrastructure\Symfony\Command;

use App\Modules\Product\Domain\Category;
use App\Modules\Product\Domain\CategoryRepository;
use App\Modules\Product\Domain\Product;
use App\Modules\Product\Domain\ProductRepository;
use App\Modules\Shared\Domain\AggregateRepository;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{
    public function __construct(
        private AggregateRepository $categoryRepository,
        private AggregateRepository $productRepository
    ) {
        parent::__construct(null);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $pid = Id::new();
        $cid = Id::new();

        $p = Product::create(
            $pid,
            SimpleString::fromStringValue('First Product')
        );
        $c1 = Category::create(
            $cid,
            SimpleString::fromStringValue('Category 1')
        );

        $c2 = Category::create(
            $cid,
            SimpleString::fromStringValue('Category 2')
        );

        $p->addCategory($c1);
        $p->addCategory($c2);

        // $p = $this->productRepository->byId($id);
        // $c = $this->categoryRepository->byId($id);

        $io->success(sprintf('ID: %s, P: %s', $pid, $p));

        return Command::SUCCESS;
    }
}
