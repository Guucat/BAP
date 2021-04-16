/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : iip

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-02-03 11:00:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for iip_all_microbe
-- ----------------------------
DROP TABLE IF EXISTS `iip_all_microbe`;
CREATE TABLE `iip_all_microbe` (
  `all_microbe__microbe_id` varchar(100) NOT NULL,
  `all_microbe__standard_name` varchar(500) DEFAULT NULL,
  `all_microbe__synonym_name` varchar(500) DEFAULT NULL,
  `all_microbe__rank` varchar(500) DEFAULT NULL,
  `all_microbe__taxid` int(100) DEFAULT NULL,
  PRIMARY KEY (`all_microbe__microbe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_all_microbe
-- ----------------------------
INSERT INTO `iip_all_microbe` VALUES ('1', '黑蝙蝠', '小黑狗蝙蝠', '哺乳动物', '1');
INSERT INTO `iip_all_microbe` VALUES ('2', '大蟑螂', '美国大蟑螂', '昆虫', '2');

-- ----------------------------
-- Table structure for iip_antibody
-- ----------------------------
DROP TABLE IF EXISTS `iip_antibody`;
CREATE TABLE `iip_antibody` (
  `antibody__antibody_id` varchar(100) NOT NULL,
  `antibody__antibody_name` varchar(500) DEFAULT NULL,
  `antibody__type` varchar(500) DEFAULT NULL,
  `antibody__microbe_id` varchar(100) DEFAULT NULL,
  `antibody__description` longtext,
  `antibody__figure_name` varchar(1024) DEFAULT NULL,
  `antibody__species_tax_id` varchar(100) DEFAULT NULL,
  `antibody__species_name` varchar(500) DEFAULT NULL,
  `antibody__research_status` varchar(500) DEFAULT NULL,
  `antibody__research_status_ref_id` varchar(100) DEFAULT NULL,
  `antibody__antigen_id` varchar(100) DEFAULT NULL,
  `antibody__antigen_epitope_id` varchar(100) DEFAULT NULL,
  `antibody__antigen_antibody_affinity` varchar(500) DEFAULT NULL,
  `antibody__antigen_antibody_affinity_ref_id` varchar(100) DEFAULT NULL,
  `antibody__antibody_screening_method` varchar(5000) DEFAULT NULL,
  `antibody__antibody_screening_method_ref_id` varchar(100) DEFAULT NULL,
  `antibody__GenBank_id` varchar(100) DEFAULT NULL,
  `antibody__Kabat_id` varchar(100) DEFAULT NULL,
  `antibody__IMGT_id` varchar(100) DEFAULT NULL,
  `antibody__abYsis_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antibody__antibody_id`),
  KEY `antibody__microbe_id` (`antibody__microbe_id`),
  KEY `antibody__research_status_ref_id` (`antibody__research_status_ref_id`),
  KEY `antibody__antigen_antibody_affinity_ref_id` (`antibody__antigen_antibody_affinity_ref_id`),
  KEY `antibody__antibody_screening_method_ref_id` (`antibody__antibody_screening_method_ref_id`),
  KEY `iip_antibody_ibfk_3` (`antibody__antigen_epitope_id`),
  CONSTRAINT `iip_antibody_ibfk_1` FOREIGN KEY (`antibody__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_antibody_ibfk_2` FOREIGN KEY (`antibody__research_status_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_antibody_ibfk_3` FOREIGN KEY (`antibody__antigen_epitope_id`) REFERENCES `iip_antigen_epitope` (`antigen_epitope__antigen_epitope_id`),
  CONSTRAINT `iip_antibody_ibfk_4` FOREIGN KEY (`antibody__antigen_antibody_affinity_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_antibody_ibfk_5` FOREIGN KEY (`antibody__antibody_screening_method_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antibody
-- ----------------------------
INSERT INTO `iip_antibody` VALUES ('1', '蝙蝠抗体', '治疗性抗体', '1', '抗体药效极强', '蝙蝠抗体横面图', '1', '小白鼠', '上市', '1', '1', '1', '亲和力强', '1', '离心筛选', '1', '1', '1', '1', '1');
INSERT INTO `iip_antibody` VALUES ('2', '蟑螂抗体', '病原性抗体', '2', '抗体药性一般', '蟑螂抗体截面图', '2', '乌龟', '研究中', '2', '2', '2', '亲和力一般', '2', '沉淀筛选', '2', '2', '2', '2', '2');

-- ----------------------------
-- Table structure for iip_antibody_structure
-- ----------------------------
DROP TABLE IF EXISTS `iip_antibody_structure`;
CREATE TABLE `iip_antibody_structure` (
  `antibody_structure__antibody_stru_id` varchar(100) NOT NULL,
  `antibody_structure__antibody_id` varchar(100) DEFAULT NULL,
  `antibody_structure__pdb_id` varchar(100) DEFAULT NULL,
  `antibody_structure__PDB_figure_name` varchar(1024) DEFAULT NULL,
  `antibody_structure__sequence_id` varchar(100) DEFAULT NULL,
  `antibody_structure__anti_sequence_type` varchar(500) DEFAULT NULL,
  `antibody_structure__ncbi_sequence_id` varchar(100) DEFAULT NULL,
  `antibody_structure__uniprot_id` varchar(100) DEFAULT NULL,
  `antibody_structure__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antibody_structure__antibody_stru_id`),
  KEY `antibody_structure__ref_id` (`antibody_structure__ref_id`),
  CONSTRAINT `iip_antibody_structure_ibfk_1` FOREIGN KEY (`antibody_structure__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antibody_structure
-- ----------------------------
INSERT INTO `iip_antibody_structure` VALUES ('1', '1', '1', '蝙蝠蛋白', '1', '蝙蝠的某些长蛋白', '1', '1', '1');
INSERT INTO `iip_antibody_structure` VALUES ('2', '2', '2', '蟑螂蛋白', '2', '蟑螂短蛋白', '2', '2', '2');

-- ----------------------------
-- Table structure for iip_antigen
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen`;
CREATE TABLE `iip_antigen` (
  `antigen__antigen_id` varchar(100) NOT NULL,
  `antigen__antigen_name` varchar(500) DEFAULT NULL,
  `antigen__microbe_id` varchar(100) DEFAULT NULL,
  `antigen__description` longtext,
  `antigen__figure_name` varchar(1024) DEFAULT NULL,
  `antigen__molecule_type` varchar(500) DEFAULT NULL,
  `antigen__uniprot_id` varchar(100) DEFAULT NULL,
  `antigen__sequence_id` varchar(100) DEFAULT NULL,
  `antigen__PDB_id` varchar(100) DEFAULT NULL,
  `antigen__PDB_figure_name` varchar(1024) DEFAULT NULL,
  `antigen__protein_type` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`antigen__antigen_id`),
  KEY `antigen__microbe_id` (`antigen__microbe_id`),
  CONSTRAINT `iip_antigen_ibfk_1` FOREIGN KEY (`antigen__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen
-- ----------------------------
INSERT INTO `iip_antigen` VALUES ('1', '蝙蝠抗原', '1', '该抗原又大又圆', '蝙蝠抗原彩色图', '蛋白质和核苷酸', '1', '1', '1', '蝙蝠抗原蛋白质图片', '核蛋白');
INSERT INTO `iip_antigen` VALUES ('2', '蟑螂抗原', '2', '该抗原又长又宽', '蟑螂抗原平面图', '核苷酸', '2', '2', '2', '蟑螂抗原蛋白图片', '膜蛋白');

-- ----------------------------
-- Table structure for iip_antigen_epitope
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen_epitope`;
CREATE TABLE `iip_antigen_epitope` (
  `antigen_epitope__antigen_epitope_id` varchar(100) NOT NULL,
  `antigen_epitope__antigen_id` varchar(100) DEFAULT NULL,
  `antigen_epitope__microbe_id` varchar(100) DEFAULT NULL,
  `antigen_epitope__type` varchar(500) DEFAULT NULL,
  `antigen_epitope__location` varchar(500) DEFAULT NULL,
  `antigen_epitope__PDB_id` varchar(100) DEFAULT NULL,
  `antigen_epitope__PDB_figure_name` varchar(1024) DEFAULT NULL,
  `antigen_epitope__antibody_id` varchar(100) DEFAULT NULL,
  `antigen_epitope__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antigen_epitope__antigen_epitope_id`),
  KEY `antigenic_epitope__antigen_id` (`antigen_epitope__antigen_id`),
  KEY `antigenic_epitope__microbe_id` (`antigen_epitope__microbe_id`),
  KEY `antigenic_epitope__ref_id` (`antigen_epitope__ref_id`),
  KEY `iip_antigenic_epitope_ibfk_4` (`antigen_epitope__antibody_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen_epitope
-- ----------------------------
INSERT INTO `iip_antigen_epitope` VALUES ('1', '1', '1', '圆形', '11号位置', '1', '表面圆形蛋白质图片', '1', '1');
INSERT INTO `iip_antigen_epitope` VALUES ('2', '2', '2', '方形', '22号位置', '2', '表面方形蛋白质图片', '1', '2');

-- ----------------------------
-- Table structure for iip_antigen_modification
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen_modification`;
CREATE TABLE `iip_antigen_modification` (
  `antigen_modification__modification_id` varchar(100) NOT NULL,
  `antigen_modification__receptor_id` varchar(100) DEFAULT NULL,
  `antigen_modification__antigen_id` varchar(100) DEFAULT NULL,
  `antigen_modification__antibody_id` varchar(100) DEFAULT NULL,
  `antigen_modification__location` varchar(500) DEFAULT NULL,
  `antigen_modification__modification_type` varchar(500) DEFAULT NULL,
  `antigen_modification__modification_desc` longtext,
  `antigen_modification__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antigen_modification__modification_id`),
  KEY `antigen_modification__receptor_id` (`antigen_modification__receptor_id`),
  KEY `antigen_modification__antigen_id` (`antigen_modification__antigen_id`),
  KEY `antigen_modification__ref_id` (`antigen_modification__ref_id`),
  KEY `iip_antigen_modification_ibfk_4` (`antigen_modification__antibody_id`),
  CONSTRAINT `iip_antigen_modification_ibfk_1` FOREIGN KEY (`antigen_modification__receptor_id`) REFERENCES `iip_microbe_receptor` (`microbe_receptor__receptor_id`),
  CONSTRAINT `iip_antigen_modification_ibfk_2` FOREIGN KEY (`antigen_modification__antigen_id`) REFERENCES `iip_antigen` (`antigen__antigen_id`),
  CONSTRAINT `iip_antigen_modification_ibfk_3` FOREIGN KEY (`antigen_modification__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_antigen_modification_ibfk_4` FOREIGN KEY (`antigen_modification__antibody_id`) REFERENCES `iip_antibody` (`antibody__antibody_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen_modification
-- ----------------------------
INSERT INTO `iip_antigen_modification` VALUES ('1', '1', '1', '1', '1号位置', '长修饰', '修饰蛋白质为圆形', '1');
INSERT INTO `iip_antigen_modification` VALUES ('2', '2', '2', '1', '2号位置', '短修饰', '修饰蛋白质为方形', '2');

-- ----------------------------
-- Table structure for iip_antigen_mutation
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen_mutation`;
CREATE TABLE `iip_antigen_mutation` (
  `antigen_mutation__AM_id` varchar(100) NOT NULL,
  `antigen_mutation__antigen_id` varchar(100) DEFAULT NULL,
  `antigen_mutation__location` varchar(500) DEFAULT NULL,
  `antigen_mutation__type` varchar(500) DEFAULT NULL,
  `antigen_mutation__immunogenicity_effection` varchar(5000) DEFAULT NULL,
  `antigen_mutation__new_antibody_id` varchar(100) DEFAULT NULL,
  `antigen_mutation__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antigen_mutation__AM_id`),
  KEY `antigen_mutation__antigen_id` (`antigen_mutation__antigen_id`),
  KEY `antigen_mutation__ref_id` (`antigen_mutation__ref_id`),
  CONSTRAINT `iip_antigen_mutation_ibfk_1` FOREIGN KEY (`antigen_mutation__antigen_id`) REFERENCES `iip_antigen` (`antigen__antigen_id`),
  CONSTRAINT `iip_antigen_mutation_ibfk_2` FOREIGN KEY (`antigen_mutation__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen_mutation
-- ----------------------------
INSERT INTO `iip_antigen_mutation` VALUES ('1', '1', '3号位置', '点突变', '影响小', '1', '1');
INSERT INTO `iip_antigen_mutation` VALUES ('2', '2', '5号位置', '跳跃突变', '影响一般', '2', '2');

-- ----------------------------
-- Table structure for iip_antigen_property
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen_property`;
CREATE TABLE `iip_antigen_property` (
  `antigen_property__antigen_id` varchar(100) NOT NULL,
  `antigen_property__hydrophobicity` varchar(500) DEFAULT NULL,
  `antigen_property__stability` varchar(500) DEFAULT NULL,
  `antigen_property__half_life` varchar(500) DEFAULT NULL,
  `antigen_property__isoelectric_point` varchar(500) DEFAULT NULL,
  `antigen_property__extinction_coefficient` varchar(500) DEFAULT NULL,
  `antigen_property__aggregate` varchar(500) DEFAULT NULL,
  `antigen_property__theory` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`antigen_property__antigen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen_property
-- ----------------------------
INSERT INTO `iip_antigen_property` VALUES ('1', '一般', '一般', '短', '2.3', '14', '是', '通过沉淀');
INSERT INTO `iip_antigen_property` VALUES ('2', '强', '强', '长', '4.5', '56', '是', '通过电击');

-- ----------------------------
-- Table structure for iip_antigen_protein_production
-- ----------------------------
DROP TABLE IF EXISTS `iip_antigen_protein_production`;
CREATE TABLE `iip_antigen_protein_production` (
  `antigen_protein_production__APP_method_id` varchar(100) NOT NULL,
  `antigen_protein_production__antigen_id` varchar(100) DEFAULT NULL,
  `antigen_protein_production__microbe_id` varchar(100) DEFAULT NULL,
  `antigen_protein_production__expression_system` longtext,
  `antigen_protein_production__expression_system_ref_id` varchar(100) DEFAULT NULL,
  `antigen_protein_production__purification` longtext,
  `antigen_protein_production__purification_ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`antigen_protein_production__APP_method_id`),
  KEY `antigen_protein_production__antigen_id` (`antigen_protein_production__antigen_id`),
  KEY `antigen_protein_production__microbe_id` (`antigen_protein_production__microbe_id`),
  KEY `antigen_protein_production__expression_system_ref_id` (`antigen_protein_production__expression_system_ref_id`),
  KEY `antigen_protein_production__purification_ref_id` (`antigen_protein_production__purification_ref_id`),
  CONSTRAINT `iip_antigen_protein_production_ibfk_1` FOREIGN KEY (`antigen_protein_production__antigen_id`) REFERENCES `iip_antigen` (`antigen__antigen_id`),
  CONSTRAINT `iip_antigen_protein_production_ibfk_2` FOREIGN KEY (`antigen_protein_production__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_antigen_protein_production_ibfk_3` FOREIGN KEY (`antigen_protein_production__expression_system_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_antigen_protein_production_ibfk_4` FOREIGN KEY (`antigen_protein_production__purification_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_antigen_protein_production
-- ----------------------------
INSERT INTO `iip_antigen_protein_production` VALUES ('1', '1', '1', '随机表达', '1', '过滤', '1');
INSERT INTO `iip_antigen_protein_production` VALUES ('2', '2', '2', '指定表达', '2', '离心', '2');

-- ----------------------------
-- Table structure for iip_clinical_testing
-- ----------------------------
DROP TABLE IF EXISTS `iip_clinical_testing`;
CREATE TABLE `iip_clinical_testing` (
  `clinical_testing__clinical_testing_id` varchar(100) NOT NULL,
  `clinical_testing__microbe_id` varchar(100) DEFAULT NULL,
  `clinical_testing__method` varchar(5000) DEFAULT NULL,
  `clinical_testing__approved_kits` varchar(2000) DEFAULT NULL,
  `clinical_testing__patent` varchar(2000) DEFAULT NULL,
  `clinical_testing__gene_id` varchar(100) DEFAULT NULL,
  `clinical_testing__sequence_id` varchar(100) DEFAULT NULL,
  `clinical_testing__primer3` varchar(2000) DEFAULT NULL,
  `clinical_testing__primer5` varchar(2000) DEFAULT NULL,
  `clinical_testing__antigen_id` varchar(100) DEFAULT NULL,
  `clinical_testing__antibody_id` varchar(100) DEFAULT NULL,
  `clinical_testing__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`clinical_testing__clinical_testing_id`),
  KEY `clinical_testing__microbe_id` (`clinical_testing__microbe_id`),
  KEY `clinical_testing__antigen_id` (`clinical_testing__antigen_id`),
  KEY `clinical_testing__antibody_id` (`clinical_testing__antibody_id`),
  KEY `clinical_testing__ref_id` (`clinical_testing__ref_id`),
  CONSTRAINT `iip_clinical_testing_ibfk_1` FOREIGN KEY (`clinical_testing__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_clinical_testing_ibfk_2` FOREIGN KEY (`clinical_testing__antigen_id`) REFERENCES `iip_antigen` (`antigen__antigen_id`),
  CONSTRAINT `iip_clinical_testing_ibfk_3` FOREIGN KEY (`clinical_testing__antibody_id`) REFERENCES `iip_antibody` (`antibody__antibody_id`),
  CONSTRAINT `iip_clinical_testing_ibfk_4` FOREIGN KEY (`clinical_testing__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_clinical_testing
-- ----------------------------
INSERT INTO `iip_clinical_testing` VALUES ('1', '1', '病原体培养', 'sagfasgas', '1684sgdas', '1', '1', 'dfasgawse', 'gasfawe', '1', '1', '1');
INSERT INTO `iip_clinical_testing` VALUES ('2', '2', '核酸检测', 'fdsgsdf', '4684gads', '2', '2', 'asbaegacv', 'hjytkt', '2', '2', '2');

-- ----------------------------
-- Table structure for iip_disease
-- ----------------------------
DROP TABLE IF EXISTS `iip_disease`;
CREATE TABLE `iip_disease` (
  `disease__disease_id` varchar(100) NOT NULL,
  `disease__disease_name` varchar(200) DEFAULT NULL,
  `disease__disease_desc` longtext,
  `disease__figure_name` varchar(1024) DEFAULT NULL,
  `disease__symptom` varchar(500) DEFAULT NULL,
  `disease__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`disease__disease_id`),
  KEY `disease__ref_id` (`disease__ref_id`),
  CONSTRAINT `iip_disease_ibfk_1` FOREIGN KEY (`disease__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_disease
-- ----------------------------
INSERT INTO `iip_disease` VALUES ('1', '新冠', '能够引起患者体温发生变化', '新冠患者图片', '发烧咳嗽', '1');
INSERT INTO `iip_disease` VALUES ('2', '皮癣', '能够引起患者皮肤感染', '皮癣患者图片', '皮肤红痒，脱皮', '2');

-- ----------------------------
-- Table structure for iip_genome_2_chr
-- ----------------------------
DROP TABLE IF EXISTS `iip_genome_2_chr`;
CREATE TABLE `iip_genome_2_chr` (
  `genome_2_chr__genome_id` varchar(100) NOT NULL,
  `genome_2_chr__chr_number` varchar(100) DEFAULT NULL,
  `genome_2_chr__ncbi_id` varchar(100) DEFAULT NULL,
  `genome_2_chr__sequence_id` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`genome_2_chr__genome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_genome_2_chr
-- ----------------------------
INSERT INTO `iip_genome_2_chr` VALUES ('1', '11', '1', '1');
INSERT INTO `iip_genome_2_chr` VALUES ('2', '22', '2', '2');

-- ----------------------------
-- Table structure for iip_genome_2_gene
-- ----------------------------
DROP TABLE IF EXISTS `iip_genome_2_gene`;
CREATE TABLE `iip_genome_2_gene` (
  `genome_2_gene__id` varchar(100) NOT NULL,
  `genome_2_gene__genome_id` varchar(100) DEFAULT NULL,
  `genome_2_gene__gene_id` varchar(100) DEFAULT NULL,
  `genome_2_gene__gene_name` varchar(200) DEFAULT NULL,
  `genome_2_gene__gene_synonym` varchar(200) DEFAULT NULL,
  `genome_2_gene__ncbi_gene_id` varchar(100) DEFAULT NULL,
  `genome_2_gene__ensembl_gene_id` varchar(100) DEFAULT NULL,
  `genome_2_gene__hgnc_gene_id` varchar(100) DEFAULT NULL,
  `genome_2_gene__sequence_id` varchar(500) DEFAULT NULL,
  `genome_2_gene__chr` varchar(100) DEFAULT NULL,
  `genome_2_gene__start` int(100) DEFAULT NULL,
  `genome_2_gene__end` int(100) DEFAULT NULL,
  `genome_2_gene__chain` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`genome_2_gene__id`),
  KEY `iip_genome_2_gene_ibfk_1` (`genome_2_gene__genome_id`),
  CONSTRAINT `iip_genome_2_gene_ibfk_1` FOREIGN KEY (`genome_2_gene__genome_id`) REFERENCES `iip_genome_2_chr` (`genome_2_chr__genome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_genome_2_gene
-- ----------------------------
INSERT INTO `iip_genome_2_gene` VALUES ('1', '1', '1', '起飞基因', '芜湖', '1', '1', '1', 'ATCCGA', '11', '1001', '1200', '+');
INSERT INTO `iip_genome_2_gene` VALUES ('2', '2', '2', '不死基因', '不怕死', '2', '2', '2', 'CCGGATC', '22', '2001', '2200', '-');

-- ----------------------------
-- Table structure for iip_microbe
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe`;
CREATE TABLE `iip_microbe` (
  `microbe__microbe_id` varchar(100) NOT NULL,
  `microbe__standard_name` varchar(200) DEFAULT NULL,
  `microbe__synonym_name` varchar(200) DEFAULT NULL,
  `microbe__rank` varchar(200) DEFAULT NULL,
  `microbe__taxid` int(100) DEFAULT NULL,
  `microbe__description` longtext,
  `microbe__figure_name` varchar(1024) DEFAULT NULL,
  `microbe__shape` varchar(200) DEFAULT NULL,
  `microbe__shape_ref` varchar(100) DEFAULT NULL,
  `microbe__size` varchar(200) DEFAULT NULL,
  `microbe__size_ref` varchar(100) DEFAULT NULL,
  `microbe__nuc_type` varchar(500) DEFAULT NULL,
  `microbe__nuc_type_ref` varchar(100) DEFAULT NULL,
  `microbe__transmission_route` varchar(500) DEFAULT NULL,
  `microbe__transmission_route_ref` varchar(100) DEFAULT NULL,
  `microbe__species_curation_status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`microbe__microbe_id`),
  KEY `microbe__shape_ref` (`microbe__shape_ref`),
  KEY `microbe__size_ref` (`microbe__size_ref`),
  KEY `microbe__nuc_type_ref` (`microbe__nuc_type_ref`),
  KEY `microbe__transmission_route_ref` (`microbe__transmission_route_ref`),
  CONSTRAINT `iip_microbe_ibfk_1` FOREIGN KEY (`microbe__shape_ref`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_microbe_ibfk_2` FOREIGN KEY (`microbe__size_ref`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_microbe_ibfk_3` FOREIGN KEY (`microbe__nuc_type_ref`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_microbe_ibfk_4` FOREIGN KEY (`microbe__transmission_route_ref`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe
-- ----------------------------
INSERT INTO `iip_microbe` VALUES ('1', '蝙蝠', '盐老鼠', '哺乳动物', '1', '头酷似小狗，有翅膀，只能倒立起飞', '最大的蝙蝠', '黑不溜秋', '1', '10多cm长', '1', 'dna,rna', '1', '空气，血液', '1', '注释中');
INSERT INTO `iip_microbe` VALUES ('2', '蟑螂', '偷油婆', '昆虫', '2', '打不死的小强', '最顽强的蟑螂', '有两根天线在头上', '2', '就3cm', '2', 'dna,rna', '2', '血液', '2', '已注释');

-- ----------------------------
-- Table structure for iip_microbe_2_genome
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_2_genome`;
CREATE TABLE `iip_microbe_2_genome` (
  `microbe_2_genome__microbe_id` varchar(100) NOT NULL,
  `microbe_2_genome__genome_id` varchar(100) DEFAULT NULL,
  `microbe_2_genome__genome_desc` longtext,
  `microbe_2_genome__figure_name` varchar(1024) DEFAULT NULL,
  `microbe_2_genome__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_2_genome__microbe_id`),
  KEY `microbe_2_genome__genome_id` (`microbe_2_genome__genome_id`),
  KEY `microbe_2_genome__ref_id` (`microbe_2_genome__ref_id`),
  CONSTRAINT `iip_microbe_2_genome_ibfk_1` FOREIGN KEY (`microbe_2_genome__genome_id`) REFERENCES `iip_genome_2_chr` (`genome_2_chr__genome_id`),
  CONSTRAINT `iip_microbe_2_genome_ibfk_2` FOREIGN KEY (`microbe_2_genome__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_2_genome
-- ----------------------------
INSERT INTO `iip_microbe_2_genome` VALUES ('1', '1', '此基因具有多段重复', '蝙蝠基因图', '1');
INSERT INTO `iip_microbe_2_genome` VALUES ('2', '2', '此基因非常短', '蟑螂基因图', '2');

-- ----------------------------
-- Table structure for iip_microbe_class
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_class`;
CREATE TABLE `iip_microbe_class` (
  `microbe_class__microbe_id` varchar(100) NOT NULL,
  `microbe_class__classify` longtext,
  `microbe_class__figure_name` varchar(1024) DEFAULT NULL,
  `microbe_class__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_class__microbe_id`),
  KEY `microbe_class__ref_id` (`microbe_class__ref_id`),
  CONSTRAINT `iip_microbe_class_ibfk_1` FOREIGN KEY (`microbe_class__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_class
-- ----------------------------
INSERT INTO `iip_microbe_class` VALUES ('1', '属于哺乳动物类', '最大的蝙蝠', '1');
INSERT INTO `iip_microbe_class` VALUES ('2', '属于昆虫类', '最强的蟑螂', '2');

-- ----------------------------
-- Table structure for iip_microbe_host
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_host`;
CREATE TABLE `iip_microbe_host` (
  `microbe_host__id` varchar(100) NOT NULL,
  `microbe_host__microbe_id` varchar(100) DEFAULT NULL,
  `microbe_host__host_species_strand_name` varchar(500) DEFAULT NULL,
  `microbe_host__host_species_synonym_name` varchar(500) DEFAULT NULL,
  `microbe_host__host_species_taxid` int(100) DEFAULT NULL,
  `microbe_host__host_type` varchar(500) DEFAULT NULL,
  `microbe_host__host_ref` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_host__id`),
  KEY `microbe_host__microbe_id` (`microbe_host__microbe_id`),
  KEY `microbe_host__host_ref` (`microbe_host__host_ref`),
  CONSTRAINT `iip_microbe_host_ibfk_1` FOREIGN KEY (`microbe_host__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_microbe_host_ibfk_2` FOREIGN KEY (`microbe_host__host_ref`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_host
-- ----------------------------
INSERT INTO `iip_microbe_host` VALUES ('1', '1', '狗', '田园犬', '1', '中间宿主', '1');
INSERT INTO `iip_microbe_host` VALUES ('2', '2', '人', '高级动物', '2', '终宿主', '2');

-- ----------------------------
-- Table structure for iip_microbe_pathogenicity
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_pathogenicity`;
CREATE TABLE `iip_microbe_pathogenicity` (
  `microbe_pathogenicity__id` varchar(100) NOT NULL,
  `microbe_pathogenicity__microbe_id` varchar(100) DEFAULT NULL,
  `microbe_pathogenicity__disease_id` varchar(100) DEFAULT NULL,
  `microbe_pathogenicity__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_pathogenicity__id`),
  KEY `microbe_pathogenicity__microbe_id` (`microbe_pathogenicity__microbe_id`),
  KEY `microbe_pathogenicity__disease_id` (`microbe_pathogenicity__disease_id`),
  KEY `microbe_pathogenicity__ref_id` (`microbe_pathogenicity__ref_id`),
  CONSTRAINT `iip_microbe_pathogenicity_ibfk_1` FOREIGN KEY (`microbe_pathogenicity__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_microbe_pathogenicity_ibfk_2` FOREIGN KEY (`microbe_pathogenicity__disease_id`) REFERENCES `iip_disease` (`disease__disease_id`),
  CONSTRAINT `iip_microbe_pathogenicity_ibfk_3` FOREIGN KEY (`microbe_pathogenicity__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_pathogenicity
-- ----------------------------
INSERT INTO `iip_microbe_pathogenicity` VALUES ('1', '1', '1', '1');
INSERT INTO `iip_microbe_pathogenicity` VALUES ('2', '2', '2', '2');

-- ----------------------------
-- Table structure for iip_microbe_receptor
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_receptor`;
CREATE TABLE `iip_microbe_receptor` (
  `microbe_receptor__receptor_id` varchar(100) NOT NULL,
  `microbe_receptor__receptor_name` varchar(500) DEFAULT NULL,
  `microbe_receptor__microbe_id` varchar(100) DEFAULT NULL,
  `microbe_receptor__receptor_desc` longtext,
  `microbe_receptor__receptor_desc_figure_name` varchar(1024) DEFAULT NULL,
  `microbe_receptor__type` varchar(500) DEFAULT NULL,
  `microbe_receptor__uniprot_id` varchar(100) DEFAULT NULL,
  `microbe_receptor__sequence_id` varchar(100) DEFAULT NULL,
  `microbe_receptor__PDB_id` varchar(100) DEFAULT NULL,
  `microbe_receptor__PDB_figure_name` varchar(1024) DEFAULT NULL,
  `microbe_receptor__receptor_ref_id` varchar(100) DEFAULT NULL,
  `microbe_receptor__invasion_mechanism_desc` longtext,
  `microbe_receptor__invasion_mechanism_desc_figure_name` varchar(1024) DEFAULT NULL,
  `microbe_receptor__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_receptor__receptor_id`),
  KEY `microbe_receptor__microbe_id` (`microbe_receptor__microbe_id`),
  KEY `microbe_receptor__receptor_ref_id` (`microbe_receptor__receptor_ref_id`),
  KEY `microbe_receptor__ref_id` (`microbe_receptor__ref_id`),
  CONSTRAINT `iip_microbe_receptor_ibfk_1` FOREIGN KEY (`microbe_receptor__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_microbe_receptor_ibfk_2` FOREIGN KEY (`microbe_receptor__receptor_ref_id`) REFERENCES `iip_reference` (`reference__ref_id`),
  CONSTRAINT `iip_microbe_receptor_ibfk_3` FOREIGN KEY (`microbe_receptor__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_receptor
-- ----------------------------
INSERT INTO `iip_microbe_receptor` VALUES ('1', '蝙蝠受体', '1', '受体呈现圆形', '蝙蝠圆形受体', '蛋白质', '1', '1', '1', '蝙蝠的蛋白质结构', '1', '通过直接侵入', '如何侵入', '1');
INSERT INTO `iip_microbe_receptor` VALUES ('2', '蟑螂受体', '2', '受体呈现方形', '蟑螂方形受体', '蛋白质', '2', '2', '2', '蟑螂的蛋白质结构', '2', '通过间接侵入', '侵入机制图', '2');

-- ----------------------------
-- Table structure for iip_microbe_tax
-- ----------------------------
DROP TABLE IF EXISTS `iip_microbe_tax`;
CREATE TABLE `iip_microbe_tax` (
  `microbe_tax__microbe_id` varchar(100) NOT NULL,
  `microbe_tax__kingdom` varchar(200) DEFAULT NULL,
  `microbe_tax__kingdom_taxid` int(100) DEFAULT NULL,
  `microbe_tax__phylum` varchar(200) DEFAULT NULL,
  `microbe_tax__phylum_taxid` int(100) DEFAULT NULL,
  `microbe_tax__class` varchar(200) DEFAULT NULL,
  `microbe_tax__class_taxid` int(100) DEFAULT NULL,
  `microbe_tax__order` varchar(200) DEFAULT NULL,
  `microbe_tax__order_taxid` int(100) DEFAULT NULL,
  `microbe_tax__family` varchar(200) DEFAULT NULL,
  `microbe_tax__family_taxid` int(100) DEFAULT NULL,
  `microbe_tax__genus` varchar(200) DEFAULT NULL,
  `microbe_tax__genus_taxid` int(100) DEFAULT NULL,
  `microbe_tax__species` varchar(200) DEFAULT NULL,
  `microbe_tax__species_taxid` int(100) DEFAULT NULL,
  `microbe_tax__serotype` varchar(200) DEFAULT NULL,
  `microbe_tax__serotype_taxid` int(100) DEFAULT NULL,
  `microbe_tax__genotype` varchar(200) DEFAULT NULL,
  `microbe_tax__genotype_taxid` int(100) DEFAULT NULL,
  PRIMARY KEY (`microbe_tax__microbe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_microbe_tax
-- ----------------------------
INSERT INTO `iip_microbe_tax` VALUES ('1', '动物界', '1', '脊索动物门', '1', '哺乳纲', '1', '翼手目', '1', '黑蝙蝠科', '1', '黑属', '1', '蝙蝠', '1', 'o', '1', 'ccagct', '1');
INSERT INTO `iip_microbe_tax` VALUES ('2', '动物界', '2', '节肢动物门 ', '2', '昆虫纲', '2', '蜚蠊目', '2', '蜚蠊科', '2', '小属', '2', '小蟑螂', '1', 'a', '2', 'ttcuaa', '2');

-- ----------------------------
-- Table structure for iip_protein_production
-- ----------------------------
DROP TABLE IF EXISTS `iip_protein_production`;
CREATE TABLE `iip_protein_production` (
  `protein_production__protein_production_id` varchar(100) NOT NULL,
  `protein_production__receptor_id` varchar(100) DEFAULT NULL,
  `protein_production__antibody_id` varchar(100) DEFAULT NULL,
  `protein_production__antigen_id` varchar(100) DEFAULT NULL,
  `protein_production__expression_system` varchar(5000) DEFAULT NULL,
  `protein_production__purification` varchar(5000) DEFAULT NULL,
  `protein_production__production_desc` longtext,
  `protein_production__figure_name` varchar(1024) DEFAULT NULL,
  `protein_production__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`protein_production__protein_production_id`),
  KEY `protein_production__receptor_id` (`protein_production__receptor_id`),
  KEY `protein_production__antibody_id` (`protein_production__antibody_id`),
  KEY `protein_production__antigen_id` (`protein_production__antigen_id`),
  KEY `protein_production__ref_id` (`protein_production__ref_id`),
  CONSTRAINT `iip_protein_production_ibfk_1` FOREIGN KEY (`protein_production__receptor_id`) REFERENCES `iip_microbe_receptor` (`microbe_receptor__receptor_id`),
  CONSTRAINT `iip_protein_production_ibfk_2` FOREIGN KEY (`protein_production__antibody_id`) REFERENCES `iip_antibody` (`antibody__antibody_id`),
  CONSTRAINT `iip_protein_production_ibfk_3` FOREIGN KEY (`protein_production__antigen_id`) REFERENCES `iip_antigen` (`antigen__antigen_id`),
  CONSTRAINT `iip_protein_production_ibfk_4` FOREIGN KEY (`protein_production__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_protein_production
-- ----------------------------
INSERT INTO `iip_protein_production` VALUES ('1', '1', '1', '1', '蝙蝠受体表达系统', '电离', '修复性极强', '蝙蝠抗体蛋白质图形', '1');
INSERT INTO `iip_protein_production` VALUES ('2', '2', '2', '2', '蟑螂受体表达系统', '沉淀', '修复性一般', '蟑螂抗体蛋白图形', '2');

-- ----------------------------
-- Table structure for iip_reference
-- ----------------------------
DROP TABLE IF EXISTS `iip_reference`;
CREATE TABLE `iip_reference` (
  `reference__ref_id` varchar(100) NOT NULL,
  `reference__title` varchar(1024) DEFAULT NULL,
  `reference__pubmed_id` int(100) DEFAULT NULL,
  `reference__doi` varchar(500) DEFAULT NULL,
  `reference__url` varchar(2038) DEFAULT NULL,
  PRIMARY KEY (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_reference
-- ----------------------------
INSERT INTO `iip_reference` VALUES ('1', '蝙蝠', '1', 'nadh', 'www.bianfu.com');
INSERT INTO `iip_reference` VALUES ('2', '蟑螂', '2', 'msky', 'www.zhanglang.com');
INSERT INTO `iip_reference` VALUES ('3', '进化', '3', 'cdsd', 'www.jinhua.com');
INSERT INTO `iip_reference` VALUES ('4', '染色体', '4', 'nadh', 'www.xibao.com');

-- ----------------------------
-- Table structure for iip_sequence
-- ----------------------------
DROP TABLE IF EXISTS `iip_sequence`;
CREATE TABLE `iip_sequence` (
  `sequence__sequence_id` varchar(100) NOT NULL,
  `sequence__sequence` longtext,
  `sequence__type` varchar(500) DEFAULT NULL,
  `sequence__sequence_desc` longtext,
  PRIMARY KEY (`sequence__sequence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_sequence
-- ----------------------------
INSERT INTO `iip_sequence` VALUES ('1', '168464', '轻链', '短');
INSERT INTO `iip_sequence` VALUES ('2', '46846168761384384', '重链', '长');

-- ----------------------------
-- Table structure for iip_source
-- ----------------------------
DROP TABLE IF EXISTS `iip_source`;
CREATE TABLE `iip_source` (
  `source_id` varchar(100) NOT NULL,
  `source_name` varchar(1024) DEFAULT NULL,
  `source_url` varchar(2038) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_source
-- ----------------------------
INSERT INTO `iip_source` VALUES ('1', '国际免疫遗传学系统（IMGT）', 'http://www.imgt.org', '2021-01-24 18:38:09', '2021-01-24 18:38:09');
INSERT INTO `iip_source` VALUES ('2', '抗原表位数据库（IEDB）', 'http://www.iedb.org', '2021-01-24 18:38:27', '2021-01-24 18:38:27');
INSERT INTO `iip_source` VALUES ('3', '抗体结构数据库（SAbDab）', 'http://opig.stats.ox.ac.uk/webapps/newsabdab/sabdab/', '2021-01-24 18:38:49', '2021-01-24 18:38:49');
INSERT INTO `iip_source` VALUES ('4', '抗体序列数据库（ABCD）', 'https://web.expasy.org/abcd/', '2021-01-24 18:39:19', '2021-01-24 18:39:19');
INSERT INTO `iip_source` VALUES ('5', '单域抗体数据库（sdAb-db）', 'http://www.sdab-db.ca', '2021-01-24 18:39:38', '2021-01-24 18:39:38');

-- ----------------------------
-- Table structure for iip_tool
-- ----------------------------
DROP TABLE IF EXISTS `iip_tool`;
CREATE TABLE `iip_tool` (
  `tool_id` varchar(100) NOT NULL,
  `tool_name` varchar(1024) DEFAULT NULL,
  `tool_url` varchar(2038) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tool_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_tool
-- ----------------------------
INSERT INTO `iip_tool` VALUES ('1', '抗体序列与结构分析（abYsis）', 'http://www.abysis.org/abysis/index.html', '2021-01-24 18:40:52', '2021-01-24 18:40:52');
INSERT INTO `iip_tool` VALUES ('2', '抗体序列编号及CDR定界工具（AbRSA）', 'http://cao.labshare.cn/AbRSA/index.html', '2021-01-24 18:41:06', '2021-01-24 18:41:06');
INSERT INTO `iip_tool` VALUES ('3', '免疫球蛋白序列比对工具（IgBlast）', 'https://www.ncbi.nlm.nih.gov/projects/igblast/', '2021-01-24 18:41:25', '2021-01-24 18:41:25');
INSERT INTO `iip_tool` VALUES ('4', '抗体预测工具集（SAbPred）', 'http://opig.stats.ox.ac.uk/webapps/newsabdab/sabpred/', '2021-01-24 18:41:37', '2021-01-24 18:41:37');

-- ----------------------------
-- Table structure for iip_user
-- ----------------------------
DROP TABLE IF EXISTS `iip_user`;
CREATE TABLE `iip_user` (
  `user_id` int(100) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_role` varchar(200) DEFAULT NULL,
  `user_password` varchar(1024) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_user
-- ----------------------------
INSERT INTO `iip_user` VALUES ('1', '小明', '注释员', '123456', '1468764@qq.com', '14646135', '2021-01-20 16:29:34', '2021-01-20 16:29:34');
INSERT INTO `iip_user` VALUES ('2', '小红', '用户', '123456', '168461631@163.com', '41643134', '2021-01-24 18:36:30', '2021-01-24 18:36:30');

-- ----------------------------
-- Table structure for iip_vaccine
-- ----------------------------
DROP TABLE IF EXISTS `iip_vaccine`;
CREATE TABLE `iip_vaccine` (
  `vaccine__vaccine_id` varchar(100) NOT NULL,
  `vaccine__vaccine_name` varchar(500) DEFAULT NULL,
  `vaccine__microbe_id` varchar(100) DEFAULT NULL,
  `vaccine__description` longtext,
  `vaccine__figure_name` varchar(1024) DEFAULT NULL,
  `vaccine__type` varchar(500) DEFAULT NULL,
  `vaccine__combination_num` varchar(500) DEFAULT NULL,
  `vaccine__valent_num` varchar(500) DEFAULT NULL,
  `vaccine__research_status` varchar(500) DEFAULT NULL,
  `vaccine__research_country` varchar(500) DEFAULT NULL,
  `vaccine__research_company` varchar(500) DEFAULT NULL,
  `vaccine__approved_country` varchar(500) DEFAULT NULL,
  `vaccine__approved_date` varchar(100) DEFAULT NULL,
  `vaccine__ref_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`vaccine__vaccine_id`),
  KEY `vaccine__microbe_id` (`vaccine__microbe_id`),
  KEY `vaccine__ref_id` (`vaccine__ref_id`),
  CONSTRAINT `iip_vaccine_ibfk_1` FOREIGN KEY (`vaccine__microbe_id`) REFERENCES `iip_microbe` (`microbe__microbe_id`),
  CONSTRAINT `iip_vaccine_ibfk_2` FOREIGN KEY (`vaccine__ref_id`) REFERENCES `iip_reference` (`reference__ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iip_vaccine
-- ----------------------------
INSERT INTO `iip_vaccine` VALUES ('1', '蝙蝠疫苗', '1', '一针见效', '蝙蝠疫苗结构图', '灭活疫苗', '单联疫苗', '单价疫苗', '上市', 'china', 'cqupt', 'china', '2010', '1');
INSERT INTO `iip_vaccine` VALUES ('2', '蟑螂疫苗', '2', '一滴就好', '蟑螂疫苗结构图', '减毒活疫苗', '二联疫苗', '三价疫苗', '临床前研究', 'china', 'cqupt', 'china', '2020', '2');
