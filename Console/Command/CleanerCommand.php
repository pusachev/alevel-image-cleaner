<?php
/**
 * Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2019, Pavel Usachev
 */

namespace ALevel\ImageCleaner\Console\Command;

use ALevel\ImageCleaner\Api\Provider\Eav\ProductImageProviderInterface as EavImageProviderInterface;
use ALevel\ImageCleaner\Api\Provider\Directory\ProductImageProviderInterface as DirImageProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class CleanerCommand extends Command
{
    const COMMAND_NAME = 'alevel:image-cleaner:cleaner';

    /**
     * @var EavImageProviderInterface
     */
    private $eavProductImageProvider;

    /** @var  */
    private $dirProductImageProvider;

    /**
     * CleanerCommand constructor.
     * @param EavImageProviderInterface $imageProvider
     * @param string|null $name
     */
    public function __construct(
        EavImageProviderInterface $imageProvider,
        DirImageProvider $dirImageProvider,
        string $name = null
    ) {
        $this->eavProductImageProvider = $imageProvider;
        $this->dirProductImageProvider = $dirImageProvider;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
             ->setDescription("Clean product images");
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $dbImages = $this->eavProductImageProvider->getImageList();
        $imagesDir = $this->dirProductImageProvider->getImageList();

        $result = array_diff($imagesDir, $dbImages);

        foreach ($result as $image) {
            $output->writeln($image);
        }
    }
}
