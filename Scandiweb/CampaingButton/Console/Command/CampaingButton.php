<?php
namespace  Scandiweb\CampaingButton\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Store\Model\StoreRepository;
use Scandiweb\CampaingButton\Helper\Data;

class CampaingButton extends Command
{
    const HEX = 'hex';
    const STOREID = 'store';

    /**
     * @var \Magento\Store\Model\StoreRepository StoreRepository
     */
    protected $_storeRepository;

    /**
     * @var Scandiweb\CampaingButton\Helper\Data $helperData
     */
    protected $_helperData;
    /***
     * CampaingButton constructor.
     *
     * @param StoreRepository $storeRepository
     */
    public function __construct (
        StoreRepository $storeRepository,
        Data $helperData
    ) {
        parent::__construct();
        $this->_storeRepository = $storeRepository;
        $this->_helperData = $helperData;
    }



    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('scandiweb:color-change');
        $this->setDescription('Change it  color button of the store for marketing campaigns.');
        $this->addOption(self::HEX, null, InputOption::VALUE_REQUIRED, self::HEX);
        $this->addOption(self::STOREID, null, InputOption::VALUE_REQUIRED, self::STOREID);
        $this->addArgument(self::HEX, null, InputOption::VALUE_REQUIRED, self::HEX);
        $this->addArgument(self::STOREID, null, InputOption::VALUE_REQUIRED, self::STOREID);
        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argValiteIs = true;
        $hex = $input->getArgument(self::HEX);
        if( !preg_match('/^#[a-f0-9]{6}$/i', $hex) && !preg_match('/^[a-f0-9]{6}$/i', $hex) ) {
            $output->writeln('<error>The first argument isn\'t a hex value.</error>');
            $argValiteIs = false;
        }
        $storeId = $input->getArgument(self::STOREID);
        try {
            $store = $this->_storeRepository->getById($storeId);
        } catch (\Exception $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');
            $argValiteIs = false;
        }
        if($argValiteIs) {
            $this->_helperData->setHexValueForButtionCampaing($hex, $store->getId());
            $output->writeln('<info>Success Message.</info>');
            $output->writeln('<comment>The button color was changed for the store : '.$store->getName().'.</comment>');
        }
    }
}
