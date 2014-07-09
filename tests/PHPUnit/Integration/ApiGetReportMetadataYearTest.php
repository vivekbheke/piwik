<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Tests\Integration;

use Piwik\Tests\IntegrationTestCase;

/**
 * test the Yearly metadata API response,
 * with no visits, with custom response language
 *
 * @group Integration
 * @group ApiGetReportMetadataYearTest
 */
class ApiGetReportMetadataYearTest extends IntegrationTestCase
{
    public static $fixture = null; // initialized below class definition

    public function getApiForTesting()
    {
        $params = array('idSite'   => self::$fixture->idSite,
                        'date'     => self::$fixture->dateTime,
                        'periods'  => 'year',
                        'language' => 'fr');
        return array(
            array('API.getProcessedReport', $params),
            array('LanguagesManager.getAvailableLanguageNames', $params),
            array('SitesManager.getJavascriptTag', $params)
        );
    }

    public static function getOutputPrefix()
    {
        return 'apiGetReportMetadata_year';
    }

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }
}

ApiGetReportMetadataYearTest::$fixture = new \Test_Piwik_Fixture_InvalidVisits();
ApiGetReportMetadataYearTest::$fixture->trackInvalidRequests = false;