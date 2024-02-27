/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.24-MariaDB : Database - ci_bsms_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci_bsms_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ci_bsms_db`;

/*Table structure for table `upwork_job` */

DROP TABLE IF EXISTS `upwork_job`;

CREATE TABLE `upwork_job` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `createdOn` datetime DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `ciphertext` varchar(30) DEFAULT NULL,
  `description` varchar(9999) DEFAULT NULL,
  `category2` varchar(15) DEFAULT NULL,
  `subcategory2` varchar(15) DEFAULT NULL,
  `duration` varchar(30) DEFAULT NULL,
  `shortDuration` varchar(15) DEFAULT NULL,
  `durationLabel` varchar(15) DEFAULT NULL,
  `engagement` varchar(15) DEFAULT NULL,
  `shortEngagement` varchar(15) DEFAULT NULL,
  `amount_currencyCode` varchar(5) DEFAULT NULL,
  `amount_amount` int(11) DEFAULT NULL,
  `recno` varchar(30) DEFAULT NULL,
  `uid` varchar(30) NOT NULL,
  `client_paymentVerificationStatus` tinyint(4) DEFAULT NULL,
  `client_location_country` varchar(30) DEFAULT NULL,
  `client_totalSpent` float DEFAULT NULL,
  `client_totalReviews` tinyint(4) DEFAULT NULL,
  `client_totalFeedback` float DEFAULT NULL,
  `client_companyRid` tinyint(4) DEFAULT NULL,
  `client_companyName` varchar(30) DEFAULT NULL,
  `client_edcUserId` tinyint(4) DEFAULT NULL,
  `client_lastContractPlatform` varchar(10) DEFAULT NULL,
  `client_lastContractRid` tinyint(4) DEFAULT NULL,
  `client_lastContractTitle` varchar(10) DEFAULT NULL,
  `client_feedbackText` varchar(30) DEFAULT NULL,
  `client_companyOrgUid` varchar(30) DEFAULT NULL,
  `client_hasFinancialPrivacy` tinyint(4) DEFAULT NULL,
  `freelancersToHire` tinyint(4) DEFAULT NULL,
  `relevanceEncoded` varchar(30) DEFAULT NULL,
  `enterpriseJob` tinyint(4) DEFAULT NULL,
  `tierText` varchar(10) DEFAULT NULL,
  `tier` varchar(10) DEFAULT NULL,
  `tierLabel` varchar(20) DEFAULT NULL,
  `isSaved` varchar(10) DEFAULT NULL,
  `feedback` varchar(10) DEFAULT NULL,
  `proposalsTier` varchar(20) DEFAULT NULL,
  `isApplied` tinyint(4) DEFAULT NULL,
  `sticky` tinyint(4) DEFAULT NULL,
  `stickyLabel` varchar(10) DEFAULT NULL,
  `jobTs` varchar(20) DEFAULT NULL,
  `prefFreelancerLocationMandatory` tinyint(4) DEFAULT NULL,
  `prefFreelancerLocation` varchar(30) DEFAULT NULL,
  `premium` tinyint(4) DEFAULT NULL,
  `plusBadge` varchar(10) DEFAULT NULL,
  `publishedOn` varchar(30) DEFAULT NULL,
  `renewedOn` varchar(10) DEFAULT NULL,
  `sandsService` varchar(10) DEFAULT NULL,
  `sandsSpec` varchar(10) DEFAULT NULL,
  `sandsAttrs` varchar(10) DEFAULT NULL,
  `occupation` varchar(10) DEFAULT NULL,
  `skills` varchar(100) DEFAULT NULL,
  `isLocal` tinyint(4) DEFAULT NULL,
  `workType` varchar(10) DEFAULT NULL,
  `locations` varchar(30) DEFAULT NULL,
  `occupations_category_uid` varchar(20) DEFAULT NULL,
  `occupations_category_prefLabel` varchar(50) DEFAULT NULL,
  `occupations_subcategories_uid` varchar(20) DEFAULT NULL,
  `occupations_subcategories_prefLabel` varchar(30) DEFAULT NULL,
  `occupations_oservice_uid` varchar(20) DEFAULT NULL,
  `occupations_oservice_prefLabel` varchar(30) DEFAULT NULL,
  `weeklyBudget` varchar(10) DEFAULT NULL,
  `hourlyBudgetText` varchar(10) DEFAULT NULL,
  `hourlyBudget_type` varchar(10) DEFAULT NULL,
  `hourlyBudget_min` varchar(10) DEFAULT NULL,
  `hourlyBudget_max` varchar(10) DEFAULT NULL,
  `tags` varchar(30) DEFAULT NULL,
  `clientRelation` varchar(10) DEFAULT NULL,
  `totalFreelancersToHire` varchar(10) DEFAULT NULL,
  `teamUid` varchar(10) DEFAULT NULL,
  `multipleFreelancersToHirePredicted` varchar(10) DEFAULT NULL,
  `connectPrice` tinyint(4) DEFAULT NULL,
  `lowdata` blob DEFAULT NULL,
  PRIMARY KEY (`id`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;



/*UPDATE upwork_job SET amount_amount = 50000 WHERE amount_amount > 50000;*/
/*UPDATE upwork_job SET hourlyBudget_max = 200 WHERE hourlyBudget_max > 200;*/