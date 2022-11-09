<?php
/*
Jaguar - A PHP framework for IT systems development
Copyright (C) 2003  Atua Sistemas de Informação Ltda.

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

You can contact Atua Sistemas de Informação Ltda by the e-mail jaguar@atua.com.br, or
885 XV de Novembro street, Passo Fundo, RS 99010-100 Brazil

Atua Sistemas de Informação Ltda., hereby disclaims all copyright interest in
the library 'Jaguar' (A PHP framework for IT systems development) written
by it's development team.

Décio Mazzutti, 22 October 2003
*/

/*
 * creation - 2002-01-06 - migliori
 *
 * 2003-04-03 - decio
 *  modificado function GetInserted(), retorna tb oid do registro
 *
 * 2003-04-08 - decio
 *  modificado function Connect, guarda em mFunction as funções do banco
 *  criado function SetLastSql, armazena ultimo sql executado
 *
 */


/**
* PostgreSQL connection class
*
* @author  Atua Sistemas de informacao
* @since   01/06/2002
* @package Jaguar
*/
Class JDBConnPgsql
{
  /**
  * Stores the database connection
  * @var object
  */
  var $mConn;

  /**
  * Stores the database connection type (persistent or not)
  * @var boolean
  */
  var $mPersistent    = true;

  /**
  * Stores the result identifier
  * @var int
  */
  var $mResult;

  /**
  * Controls if there is an opened transaction
  * @var boolean
  */
  var $mHasTransaction;

  /**
  * Stores an array with the PostgreSQL functions' names
  * @var array
  */
  var $mFunctions;

  /**
  * Stores an array with Reserved Words
  * @var array
  */
  var $mReservedWords;

  /**
  * Stores most recently executed SQL statement
  * @var string
  */
  var $mLastSql;

  /**
  * Controls if the database uses external increment or not
  * @var boolean
  */
  var $mUseExternalIncrement = true;

  /**
  * Stores the command that starts a trasaction in this database
  * @var string
  */
  var $mBeginTransaction = "begin";

  /**
   * Stores the command that creates a savepoint in this database
   * @var string
   */
  var $mSavepoint = "SAVEPOINT";

  /**
   * Stores the command that releases a savepoint in this database
   * @var string
   */
  var $mReleaseSavepoint = "RELEASE SAVEPOINT";

  /**
   * Stores the command that rolls back to a savepoint in this database
   * @var string
   */
  var $mRollBackToSavepoint = "ROLLBACK TO SAVEPOINT";

  /**
  * Stores the command that commits a trasaction in this database
  * @var string
  */
  var $mCommit = "commit";

  /**
  * Stores the command that cancels a trasaction in this database
  * @var string
  */
  var $mRollback = "rollback";

  /**
  * Constructor
  */
  function __construct()
  {
    /* Store at attribute mFunctions the result from query:
     * SELECT DISTINCT LOWER(proname)
     *   FROM pg_proc p 
     *   JOIN pg_namespace n ON n.oid = p.pronamespace 
     *  WHERE nspname = 'pg_catalog'
     *  ORDER BY 1
     */
    $this->mFunctions = array(
      "abbrev",
      "abs",
      "abstime",
      "abstimeeq",
      "abstimege",
      "abstimegt",
      "abstimein",
      "abstimele",
      "abstimelt",
      "abstimene",
      "abstimeout",
      "abstimerecv",
      "abstimesend",
      "aclcontains",
      "aclexplode",
      "aclinsert",
      "aclitemeq",
      "aclitemin",
      "aclitemout",
      "aclremove",
      "acos",
      "age",
      "anyarray_in",
      "anyarray_out",
      "anyarray_recv",
      "anyarray_send",
      "anyelement_in",
      "anyelement_out",
      "anyenum_in",
      "anyenum_out",
      "any_in",
      "anynonarray_in",
      "anynonarray_out",
      "any_out",
      "anytextcat",
      "area",
      "areajoinsel",
      "areasel",
      "array_agg",
      "array_agg_finalfn",
      "array_agg_transfn",
      "array_append",
      "array_cat",
      "arraycontained",
      "arraycontains",
      "array_dims",
      "array_eq",
      "array_fill",
      "array_ge",
      "array_gt",
      "array_in",
      "array_larger",
      "array_le",
      "array_length",
      "array_lower",
      "array_lt",
      "array_ndims",
      "array_ne",
      "array_out",
      "arrayoverlap",
      "array_prepend",
      "array_recv",
      "array_remove",
      "array_send",
      "array_smaller",
      "array_to_string",
      "array_upper",
      "ascii",
      "ascii_to_mic",
      "ascii_to_utf8",
      "asin",
      "atan",
      "atan2",
      "avg",
      "big5_to_euc_tw",
      "big5_to_mic",
      "big5_to_utf8",
      "bit",
      "bitand",
      "bit_and",
      "bitcat",
      "bitcmp",
      "biteq",
      "bitge",
      "bitgt",
      "bit_in",
      "bitle",
      "bit_length",
      "bitlt",
      "bitne",
      "bitnot",
      "bitor",
      "bit_or",
      "bit_out",
      "bit_recv",
      "bit_send",
      "bitshiftleft",
      "bitshiftright",
      "bittypmodin",
      "bittypmodout",
      "bitxor",
      "bool",
      "bool_and",
      "booland_statefunc",
      "booleq",
      "boolge",
      "boolgt",
      "boolin",
      "boolle",
      "boollt",
      "boolne",
      "bool_or",
      "boolor_statefunc",
      "boolout",
      "boolrecv",
      "boolsend",
      "box",
      "box_above",
      "box_above_eq",
      "box_add",
      "box_below",
      "box_below_eq",
      "box_center",
      "box_contain",
      "box_contained",
      "box_contain_pt",
      "box_distance",
      "box_div",
      "box_eq",
      "box_ge",
      "box_gt",
      "box_in",
      "box_intersect",
      "box_le",
      "box_left",
      "box_lt",
      "box_mul",
      "box_out",
      "box_overabove",
      "box_overbelow",
      "box_overlap",
      "box_overleft",
      "box_overright",
      "box_recv",
      "box_right",
      "box_same",
      "box_send",
      "box_sub",
      "bpchar",
      "bpcharcmp",
      "bpchareq",
      "bpcharge",
      "bpchargt",
      "bpchariclike",
      "bpcharicnlike",
      "bpcharicregexeq",
      "bpcharicregexne",
      "bpcharin",
      "bpchar_larger",
      "bpcharle",
      "bpcharlike",
      "bpcharlt",
      "bpcharne",
      "bpcharnlike",
      "bpcharout",
      "bpchar_pattern_ge",
      "bpchar_pattern_gt",
      "bpchar_pattern_le",
      "bpchar_pattern_lt",
      "bpcharrecv",
      "bpcharregexeq",
      "bpcharregexne",
      "bpcharsend",
      "bpchar_smaller",
      "bpchartypmodin",
      "bpchartypmodout",
      "broadcast",
      "btabstimecmp",
      "btarraycmp",
      "btbeginscan",
      "btboolcmp",
      "btbpchar_pattern_cmp",
      "btbuild",
      "btbuildempty",
      "btbulkdelete",
      "btcharcmp",
      "btcostestimate",
      "btendscan",
      "btfloat48cmp",
      "btfloat4cmp",
      "btfloat84cmp",
      "btfloat8cmp",
      "btgetbitmap",
      "btgettuple",
      "btinsert",
      "btint24cmp",
      "btint28cmp",
      "btint2cmp",
      "btint42cmp",
      "btint48cmp",
      "btint4cmp",
      "btint82cmp",
      "btint84cmp",
      "btint8cmp",
      "btmarkpos",
      "btnamecmp",
      "btoidcmp",
      "btoidvectorcmp",
      "btoptions",
      "btrecordcmp",
      "btreltimecmp",
      "btrescan",
      "btrestrpos",
      "btrim",
      "bttextcmp",
      "bttext_pattern_cmp",
      "bttidcmp",
      "bttintervalcmp",
      "btvacuumcleanup",
      "byteacat",
      "byteacmp",
      "byteaeq",
      "byteage",
      "byteagt",
      "byteain",
      "byteale",
      "bytealike",
      "bytealt",
      "byteane",
      "byteanlike",
      "byteaout",
      "bytearecv",
      "byteasend",
      "cash_cmp",
      "cash_div_cash",
      "cash_div_flt4",
      "cash_div_flt8",
      "cash_div_int2",
      "cash_div_int4",
      "cash_eq",
      "cash_ge",
      "cash_gt",
      "cash_in",
      "cashlarger",
      "cash_le",
      "cash_lt",
      "cash_mi",
      "cash_mul_flt4",
      "cash_mul_flt8",
      "cash_mul_int2",
      "cash_mul_int4",
      "cash_ne",
      "cash_out",
      "cash_pl",
      "cash_recv",
      "cash_send",
      "cashsmaller",
      "cash_words",
      "cbrt",
      "ceil",
      "ceiling",
      "center",
      "char",
      "character_length",
      "chareq",
      "charge",
      "chargt",
      "charin",
      "charle",
      "char_length",
      "charlt",
      "charne",
      "charout",
      "charrecv",
      "charsend",
      "chr",
      "cideq",
      "cidin",
      "cidout",
      "cidr",
      "cidrecv",
      "cidr_in",
      "cidr_out",
      "cidr_recv",
      "cidr_send",
      "cidsend",
      "circle",
      "circle_above",
      "circle_add_pt",
      "circle_below",
      "circle_center",
      "circle_contain",
      "circle_contained",
      "circle_contain_pt",
      "circle_distance",
      "circle_div_pt",
      "circle_eq",
      "circle_ge",
      "circle_gt",
      "circle_in",
      "circle_le",
      "circle_left",
      "circle_lt",
      "circle_mul_pt",
      "circle_ne",
      "circle_out",
      "circle_overabove",
      "circle_overbelow",
      "circle_overlap",
      "circle_overleft",
      "circle_overright",
      "circle_recv",
      "circle_right",
      "circle_same",
      "circle_send",
      "circle_sub_pt",
      "clock_timestamp",
      "close_lb",
      "close_ls",
      "close_lseg",
      "close_pb",
      "close_pl",
      "close_ps",
      "close_sb",
      "close_sl",
      "col_description",
      "concat",
      "concat_ws",
      "contjoinsel",
      "contsel",
      "convert",
      "convert_from",
      "convert_to",
      "corr",
      "cos",
      "cot",
      "count",
      "covar_pop",
      "covar_samp",
      "cstring_in",
      "cstring_out",
      "cstring_recv",
      "cstring_send",
      "cume_dist",
      "current_database",
      "current_query",
      "current_schema",
      "current_schemas",
      "current_setting",
      "current_user",
      "currtid",
      "currtid2",
      "currval",
      "cursor_to_xml",
      "cursor_to_xmlschema",
      "database_to_xml",
      "database_to_xml_and_xmlschema",
      "database_to_xmlschema",
      "date",
      "date_cmp",
      "date_cmp_timestamp",
      "date_cmp_timestamptz",
      "date_eq",
      "date_eq_timestamp",
      "date_eq_timestamptz",
      "date_ge",
      "date_ge_timestamp",
      "date_ge_timestamptz",
      "date_gt",
      "date_gt_timestamp",
      "date_gt_timestamptz",
      "date_in",
      "date_larger",
      "date_le",
      "date_le_timestamp",
      "date_le_timestamptz",
      "date_lt",
      "date_lt_timestamp",
      "date_lt_timestamptz",
      "date_mi",
      "date_mii",
      "date_mi_interval",
      "date_ne",
      "date_ne_timestamp",
      "date_ne_timestamptz",
      "date_out",
      "date_part",
      "date_pli",
      "date_pl_interval",
      "date_recv",
      "date_send",
      "date_smaller",
      "datetime_pl",
      "datetimetz_pl",
      "date_trunc",
      "dcbrt",
      "decode",
      "degrees",
      "dense_rank",
      "dexp",
      "diagonal",
      "diameter",
      "dispell_init",
      "dispell_lexize",
      "dist_cpoly",
      "dist_lb",
      "dist_pb",
      "dist_pc",
      "dist_pl",
      "dist_ppath",
      "dist_ps",
      "dist_sb",
      "dist_sl",
      "div",
      "dlog1",
      "dlog10",
      "domain_in",
      "domain_recv",
      "dpow",
      "dround",
      "dsimple_init",
      "dsimple_lexize",
      "dsnowball_init",
      "dsnowball_lexize",
      "dsqrt",
      "dsynonym_init",
      "dsynonym_lexize",
      "dtrunc",
      "encode",
      "enum_cmp",
      "enum_eq",
      "enum_first",
      "enum_ge",
      "enum_gt",
      "enum_in",
      "enum_larger",
      "enum_last",
      "enum_le",
      "enum_lt",
      "enum_ne",
      "enum_out",
      "enum_range",
      "enum_recv",
      "enum_send",
      "enum_smaller",
      "eqjoinsel",
      "eqsel",
      "euc_cn_to_mic",
      "euc_cn_to_utf8",
      "euc_jis_2004_to_shift_jis_2004",
      "euc_jis_2004_to_utf8",
      "euc_jp_to_mic",
      "euc_jp_to_sjis",
      "euc_jp_to_utf8",
      "euc_kr_to_mic",
      "euc_kr_to_utf8",
      "euc_tw_to_big5",
      "euc_tw_to_mic",
      "euc_tw_to_utf8",
      "every",
      "exp",
      "factorial",
      "family",
      "fdw_handler_in",
      "fdw_handler_out",
      "first_value",
      "float4",
      "float48div",
      "float48eq",
      "float48ge",
      "float48gt",
      "float48le",
      "float48lt",
      "float48mi",
      "float48mul",
      "float48ne",
      "float48pl",
      "float4abs",
      "float4_accum",
      "float4div",
      "float4eq",
      "float4ge",
      "float4gt",
      "float4in",
      "float4larger",
      "float4le",
      "float4lt",
      "float4mi",
      "float4mul",
      "float4ne",
      "float4out",
      "float4pl",
      "float4recv",
      "float4send",
      "float4smaller",
      "float4um",
      "float4up",
      "float8",
      "float84div",
      "float84eq",
      "float84ge",
      "float84gt",
      "float84le",
      "float84lt",
      "float84mi",
      "float84mul",
      "float84ne",
      "float84pl",
      "float8abs",
      "float8_accum",
      "float8_avg",
      "float8_corr",
      "float8_covar_pop",
      "float8_covar_samp",
      "float8div",
      "float8eq",
      "float8ge",
      "float8gt",
      "float8in",
      "float8larger",
      "float8le",
      "float8lt",
      "float8mi",
      "float8mul",
      "float8ne",
      "float8out",
      "float8pl",
      "float8recv",
      "float8_regr_accum",
      "float8_regr_avgx",
      "float8_regr_avgy",
      "float8_regr_intercept",
      "float8_regr_r2",
      "float8_regr_slope",
      "float8_regr_sxx",
      "float8_regr_sxy",
      "float8_regr_syy",
      "float8send",
      "float8smaller",
      "float8_stddev_pop",
      "float8_stddev_samp",
      "float8um",
      "float8up",
      "float8_var_pop",
      "float8_var_samp",
      "floor",
      "flt4_mul_cash",
      "flt8_mul_cash",
      "fmgr_c_validator",
      "fmgr_internal_validator",
      "fmgr_sql_validator",
      "format",
      "format_type",
      "gb18030_to_utf8",
      "gbk_to_utf8",
      "generate_series",
      "generate_subscripts",
      "get_bit",
      "get_byte",
      "get_current_ts_config",
      "getdatabaseencoding",
      "getpgusername",
      "ginarrayconsistent",
      "ginarrayextract",
      "ginbeginscan",
      "ginbuild",
      "ginbuildempty",
      "ginbulkdelete",
      "gin_cmp_prefix",
      "gin_cmp_tslexeme",
      "gincostestimate",
      "ginendscan",
      "gin_extract_tsquery",
      "gin_extract_tsvector",
      "gingetbitmap",
      "gininsert",
      "ginmarkpos",
      "ginoptions",
      "ginqueryarrayextract",
      "ginrescan",
      "ginrestrpos",
      "gin_tsquery_consistent",
      "ginvacuumcleanup",
      "gistbeginscan",
      "gist_box_compress",
      "gist_box_consistent",
      "gist_box_decompress",
      "gist_box_penalty",
      "gist_box_picksplit",
      "gist_box_same",
      "gist_box_union",
      "gistbuild",
      "gistbuildempty",
      "gistbulkdelete",
      "gist_circle_compress",
      "gist_circle_consistent",
      "gistcostestimate",
      "gistendscan",
      "gistgetbitmap",
      "gistgettuple",
      "gistinsert",
      "gistmarkpos",
      "gistoptions",
      "gist_point_compress",
      "gist_point_consistent",
      "gist_point_distance",
      "gist_poly_compress",
      "gist_poly_consistent",
      "gistrescan",
      "gistrestrpos",
      "gistvacuumcleanup",
      "gtsquery_compress",
      "gtsquery_consistent",
      "gtsquery_decompress",
      "gtsquery_penalty",
      "gtsquery_picksplit",
      "gtsquery_same",
      "gtsquery_union",
      "gtsvector_compress",
      "gtsvector_consistent",
      "gtsvector_decompress",
      "gtsvectorin",
      "gtsvectorout",
      "gtsvector_penalty",
      "gtsvector_picksplit",
      "gtsvector_same",
      "gtsvector_union",
      "has_any_column_privilege",
      "has_column_privilege",
      "has_database_privilege",
      "has_foreign_data_wrapper_privilege",
      "has_function_privilege",
      "hash_aclitem",
      "hash_array",
      "hashbeginscan",
      "hashbpchar",
      "hashbuild",
      "hashbuildempty",
      "hashbulkdelete",
      "hashchar",
      "hashcostestimate",
      "hashendscan",
      "hashenum",
      "hashfloat4",
      "hashfloat8",
      "hashgetbitmap",
      "hashgettuple",
      "hashinet",
      "hashinsert",
      "hashint2",
      "hashint2vector",
      "hashint4",
      "hashint8",
      "hashmacaddr",
      "hashmarkpos",
      "hashname",
      "hash_numeric",
      "hashoid",
      "hashoidvector",
      "hashoptions",
      "hashrescan",
      "hashrestrpos",
      "hashtext",
      "hashvacuumcleanup",
      "hashvarlena",
      "has_language_privilege",
      "has_schema_privilege",
      "has_sequence_privilege",
      "has_server_privilege",
      "has_table_privilege",
      "has_tablespace_privilege",
      "height",
      "host",
      "hostmask",
      "iclikejoinsel",
      "iclikesel",
      "icnlikejoinsel",
      "icnlikesel",
      "icregexeqjoinsel",
      "icregexeqsel",
      "icregexnejoinsel",
      "icregexnesel",
      "inetand",
      "inet_client_addr",
      "inet_client_port",
      "inet_in",
      "inetmi",
      "inetmi_int8",
      "inetnot",
      "inetor",
      "inet_out",
      "inetpl",
      "inet_recv",
      "inet_send",
      "inet_server_addr",
      "inet_server_port",
      "initcap",
      "int2",
      "int24div",
      "int24eq",
      "int24ge",
      "int24gt",
      "int24le",
      "int24lt",
      "int24mi",
      "int24mul",
      "int24ne",
      "int24pl",
      "int28div",
      "int28eq",
      "int28ge",
      "int28gt",
      "int28le",
      "int28lt",
      "int28mi",
      "int28mul",
      "int28ne",
      "int28pl",
      "int2abs",
      "int2_accum",
      "int2and",
      "int2_avg_accum",
      "int2div",
      "int2eq",
      "int2ge",
      "int2gt",
      "int2in",
      "int2larger",
      "int2le",
      "int2lt",
      "int2mi",
      "int2mod",
      "int2mul",
      "int2_mul_cash",
      "int2ne",
      "int2not",
      "int2or",
      "int2out",
      "int2pl",
      "int2recv",
      "int2send",
      "int2shl",
      "int2shr",
      "int2smaller",
      "int2_sum",
      "int2um",
      "int2up",
      "int2vectoreq",
      "int2vectorin",
      "int2vectorout",
      "int2vectorrecv",
      "int2vectorsend",
      "int2xor",
      "int4",
      "int42div",
      "int42eq",
      "int42ge",
      "int42gt",
      "int42le",
      "int42lt",
      "int42mi",
      "int42mul",
      "int42ne",
      "int42pl",
      "int48div",
      "int48eq",
      "int48ge",
      "int48gt",
      "int48le",
      "int48lt",
      "int48mi",
      "int48mul",
      "int48ne",
      "int48pl",
      "int4abs",
      "int4_accum",
      "int4and",
      "int4_avg_accum",
      "int4div",
      "int4eq",
      "int4ge",
      "int4gt",
      "int4in",
      "int4inc",
      "int4larger",
      "int4le",
      "int4lt",
      "int4mi",
      "int4mod",
      "int4mul",
      "int4_mul_cash",
      "int4ne",
      "int4not",
      "int4or",
      "int4out",
      "int4pl",
      "int4recv",
      "int4send",
      "int4shl",
      "int4shr",
      "int4smaller",
      "int4_sum",
      "int4um",
      "int4up",
      "int4xor",
      "int8",
      "int82div",
      "int82eq",
      "int82ge",
      "int82gt",
      "int82le",
      "int82lt",
      "int82mi",
      "int82mul",
      "int82ne",
      "int82pl",
      "int84div",
      "int84eq",
      "int84ge",
      "int84gt",
      "int84le",
      "int84lt",
      "int84mi",
      "int84mul",
      "int84ne",
      "int84pl",
      "int8abs",
      "int8_accum",
      "int8and",
      "int8_avg",
      "int8_avg_accum",
      "int8div",
      "int8eq",
      "int8ge",
      "int8gt",
      "int8in",
      "int8inc",
      "int8inc_any",
      "int8inc_float8_float8",
      "int8larger",
      "int8le",
      "int8lt",
      "int8mi",
      "int8mod",
      "int8mul",
      "int8ne",
      "int8not",
      "int8or",
      "int8out",
      "int8pl",
      "int8pl_inet",
      "int8recv",
      "int8send",
      "int8shl",
      "int8shr",
      "int8smaller",
      "int8_sum",
      "int8um",
      "int8up",
      "int8xor",
      "integer_pl_date",
      "inter_lb",
      "internal_in",
      "internal_out",
      "inter_sb",
      "inter_sl",
      "interval",
      "interval_accum",
      "interval_avg",
      "interval_cmp",
      "interval_div",
      "interval_eq",
      "interval_ge",
      "interval_gt",
      "interval_hash",
      "interval_in",
      "interval_larger",
      "interval_le",
      "interval_lt",
      "interval_mi",
      "interval_mul",
      "interval_ne",
      "interval_out",
      "interval_pl",
      "interval_pl_date",
      "interval_pl_time",
      "interval_pl_timestamp",
      "interval_pl_timestamptz",
      "interval_pl_timetz",
      "interval_recv",
      "interval_send",
      "interval_smaller",
      "intervaltypmodin",
      "intervaltypmodout",
      "interval_um",
      "intinterval",
      "isclosed",
      "isfinite",
      "ishorizontal",
      "iso8859_1_to_utf8",
      "iso8859_to_utf8",
      "isopen",
      "iso_to_koi8r",
      "iso_to_mic",
      "iso_to_win1251",
      "iso_to_win866",
      "isparallel",
      "isperp",
      "isvertical",
      "johab_to_utf8",
      "justify_days",
      "justify_hours",
      "justify_interval",
      "koi8r_to_iso",
      "koi8r_to_mic",
      "koi8r_to_utf8",
      "koi8r_to_win1251",
      "koi8r_to_win866",
      "koi8u_to_utf8",
      "lag",
      "language_handler_in",
      "language_handler_out",
      "lastval",
      "last_value",
      "latin1_to_mic",
      "latin2_to_mic",
      "latin2_to_win1250",
      "latin3_to_mic",
      "latin4_to_mic",
      "lead",
      "left",
      "length",
      "like",
      "like_escape",
      "likejoinsel",
      "likesel",
      "line",
      "line_distance",
      "line_eq",
      "line_horizontal",
      "line_in",
      "line_interpt",
      "line_intersect",
      "line_out",
      "line_parallel",
      "line_perp",
      "line_recv",
      "line_send",
      "line_vertical",
      "ln",
      "lo_close",
      "lo_creat",
      "lo_create",
      "lo_export",
      "log",
      "lo_import",
      "lo_lseek",
      "lo_open",
      "loread",
      "lo_tell",
      "lo_truncate",
      "lo_unlink",
      "lower",
      "lowrite",
      "lpad",
      "lseg",
      "lseg_center",
      "lseg_distance",
      "lseg_eq",
      "lseg_ge",
      "lseg_gt",
      "lseg_horizontal",
      "lseg_in",
      "lseg_interpt",
      "lseg_intersect",
      "lseg_le",
      "lseg_length",
      "lseg_lt",
      "lseg_ne",
      "lseg_out",
      "lseg_parallel",
      "lseg_perp",
      "lseg_recv",
      "lseg_send",
      "lseg_vertical",
      "ltrim",
      "macaddr_cmp",
      "macaddr_eq",
      "macaddr_ge",
      "macaddr_gt",
      "macaddr_in",
      "macaddr_le",
      "macaddr_lt",
      "macaddr_ne",
      "macaddr_out",
      "macaddr_recv",
      "macaddr_send",
      "makeaclitem",
      "masklen",
      "max",
      "md5",
      "mic_to_ascii",
      "mic_to_big5",
      "mic_to_euc_cn",
      "mic_to_euc_jp",
      "mic_to_euc_kr",
      "mic_to_euc_tw",
      "mic_to_iso",
      "mic_to_koi8r",
      "mic_to_latin1",
      "mic_to_latin2",
      "mic_to_latin3",
      "mic_to_latin4",
      "mic_to_sjis",
      "mic_to_win1250",
      "mic_to_win1251",
      "mic_to_win866",
      "min",
      "mktinterval",
      "mod",
      "money",
      "mul_d_interval",
      "name",
      "nameeq",
      "namege",
      "namegt",
      "nameiclike",
      "nameicnlike",
      "nameicregexeq",
      "nameicregexne",
      "namein",
      "namele",
      "namelike",
      "namelt",
      "namene",
      "namenlike",
      "nameout",
      "namerecv",
      "nameregexeq",
      "nameregexne",
      "namesend",
      "neqjoinsel",
      "neqsel",
      "netmask",
      "network",
      "network_cmp",
      "network_eq",
      "network_ge",
      "network_gt",
      "network_le",
      "network_lt",
      "network_ne",
      "network_sub",
      "network_subeq",
      "network_sup",
      "network_supeq",
      "nextval",
      "nlikejoinsel",
      "nlikesel",
      "notlike",
      "now",
      "npoints",
      "nth_value",
      "ntile",
      "numeric",
      "numeric_abs",
      "numeric_accum",
      "numeric_add",
      "numeric_avg",
      "numeric_avg_accum",
      "numeric_cmp",
      "numeric_div",
      "numeric_div_trunc",
      "numeric_eq",
      "numeric_exp",
      "numeric_fac",
      "numeric_ge",
      "numeric_gt",
      "numeric_in",
      "numeric_inc",
      "numeric_larger",
      "numeric_le",
      "numeric_ln",
      "numeric_log",
      "numeric_lt",
      "numeric_mod",
      "numeric_mul",
      "numeric_ne",
      "numeric_out",
      "numeric_power",
      "numeric_recv",
      "numeric_send",
      "numeric_smaller",
      "numeric_sqrt",
      "numeric_stddev_pop",
      "numeric_stddev_samp",
      "numeric_sub",
      "numerictypmodin",
      "numerictypmodout",
      "numeric_uminus",
      "numeric_uplus",
      "numeric_var_pop",
      "numeric_var_samp",
      "numnode",
      "obj_description",
      "octet_length",
      "oid",
      "oideq",
      "oidge",
      "oidgt",
      "oidin",
      "oidlarger",
      "oidle",
      "oidlt",
      "oidne",
      "oidout",
      "oidrecv",
      "oidsend",
      "oidsmaller",
      "oidvectoreq",
      "oidvectorge",
      "oidvectorgt",
      "oidvectorin",
      "oidvectorle",
      "oidvectorlt",
      "oidvectorne",
      "oidvectorout",
      "oidvectorrecv",
      "oidvectorsend",
      "oidvectortypes",
      "on_pb",
      "on_pl",
      "on_ppath",
      "on_ps",
      "on_sb",
      "on_sl",
      "opaque_in",
      "opaque_out",
      "overlaps",
      "overlay",
      "path",
      "path_add",
      "path_add_pt",
      "path_center",
      "path_contain_pt",
      "path_distance",
      "path_div_pt",
      "path_in",
      "path_inter",
      "path_length",
      "path_mul_pt",
      "path_n_eq",
      "path_n_ge",
      "path_n_gt",
      "path_n_le",
      "path_n_lt",
      "path_npoints",
      "path_out",
      "path_recv",
      "path_send",
      "path_sub_pt",
      "pclose",
      "percent_rank",
      "pg_advisory_lock",
      "pg_advisory_lock_shared",
      "pg_advisory_unlock",
      "pg_advisory_unlock_all",
      "pg_advisory_unlock_shared",
      "pg_advisory_xact_lock",
      "pg_advisory_xact_lock_shared",
      "pg_available_extensions",
      "pg_available_extension_versions",
      "pg_backend_pid",
      "pg_cancel_backend",
      "pg_char_to_encoding",
      "pg_client_encoding",
      "pg_collation_is_visible",
      "pg_column_size",
      "pg_conf_load_time",
      "pg_conversion_is_visible",
      "pg_create_restore_point",
      "pg_current_xlog_insert_location",
      "pg_current_xlog_location",
      "pg_cursor",
      "pg_database_size",
      "pg_describe_object",
      "pg_encoding_max_length",
      "pg_encoding_to_char",
      "pg_extension_config_dump",
      "pg_extension_update_paths",
      "pg_function_is_visible",
      "pg_get_constraintdef",
      "pg_get_expr",
      "pg_get_function_arguments",
      "pg_get_functiondef",
      "pg_get_function_identity_arguments",
      "pg_get_function_result",
      "pg_get_indexdef",
      "pg_get_keywords",
      "pg_get_ruledef",
      "pg_get_serial_sequence",
      "pg_get_triggerdef",
      "pg_get_userbyid",
      "pg_get_viewdef",
      "pg_has_role",
      "pg_indexes_size",
      "pg_is_in_recovery",
      "pg_is_other_temp_schema",
      "pg_is_xlog_replay_paused",
      "pg_last_xact_replay_timestamp",
      "pg_last_xlog_receive_location",
      "pg_last_xlog_replay_location",
      "pg_listening_channels",
      "pg_lock_status",
      "pg_ls_dir",
      "pg_my_temp_schema",
      "pg_node_tree_in",
      "pg_node_tree_out",
      "pg_node_tree_recv",
      "pg_node_tree_send",
      "pg_notify",
      "pg_opclass_is_visible",
      "pg_operator_is_visible",
      "pg_options_to_table",
      "pg_postmaster_start_time",
      "pg_prepared_statement",
      "pg_prepared_xact",
      "pg_read_binary_file",
      "pg_read_file",
      "pg_relation_filenode",
      "pg_relation_filepath",
      "pg_relation_size",
      "pg_reload_conf",
      "pg_rotate_logfile",
      "pg_sequence_parameters",
      "pg_show_all_settings",
      "pg_size_pretty",
      "pg_sleep",
      "pg_start_backup",
      "pg_stat_clear_snapshot",
      "pg_stat_file",
      "pg_stat_get_activity",
      "pg_stat_get_analyze_count",
      "pg_stat_get_autoanalyze_count",
      "pg_stat_get_autovacuum_count",
      "pg_stat_get_backend_activity",
      "pg_stat_get_backend_activity_start",
      "pg_stat_get_backend_client_addr",
      "pg_stat_get_backend_client_port",
      "pg_stat_get_backend_dbid",
      "pg_stat_get_backend_idset",
      "pg_stat_get_backend_pid",
      "pg_stat_get_backend_start",
      "pg_stat_get_backend_userid",
      "pg_stat_get_backend_waiting",
      "pg_stat_get_backend_xact_start",
      "pg_stat_get_bgwriter_buf_written_checkpoints",
      "pg_stat_get_bgwriter_buf_written_clean",
      "pg_stat_get_bgwriter_maxwritten_clean",
      "pg_stat_get_bgwriter_requested_checkpoints",
      "pg_stat_get_bgwriter_stat_reset_time",
      "pg_stat_get_bgwriter_timed_checkpoints",
      "pg_stat_get_blocks_fetched",
      "pg_stat_get_blocks_hit",
      "pg_stat_get_buf_alloc",
      "pg_stat_get_buf_fsync_backend",
      "pg_stat_get_buf_written_backend",
      "pg_stat_get_db_blocks_fetched",
      "pg_stat_get_db_blocks_hit",
      "pg_stat_get_db_conflict_all",
      "pg_stat_get_db_conflict_bufferpin",
      "pg_stat_get_db_conflict_lock",
      "pg_stat_get_db_conflict_snapshot",
      "pg_stat_get_db_conflict_startup_deadlock",
      "pg_stat_get_db_conflict_tablespace",
      "pg_stat_get_db_numbackends",
      "pg_stat_get_db_stat_reset_time",
      "pg_stat_get_db_tuples_deleted",
      "pg_stat_get_db_tuples_fetched",
      "pg_stat_get_db_tuples_inserted",
      "pg_stat_get_db_tuples_returned",
      "pg_stat_get_db_tuples_updated",
      "pg_stat_get_db_xact_commit",
      "pg_stat_get_db_xact_rollback",
      "pg_stat_get_dead_tuples",
      "pg_stat_get_function_calls",
      "pg_stat_get_function_self_time",
      "pg_stat_get_function_time",
      "pg_stat_get_last_analyze_time",
      "pg_stat_get_last_autoanalyze_time",
      "pg_stat_get_last_autovacuum_time",
      "pg_stat_get_last_vacuum_time",
      "pg_stat_get_live_tuples",
      "pg_stat_get_numscans",
      "pg_stat_get_tuples_deleted",
      "pg_stat_get_tuples_fetched",
      "pg_stat_get_tuples_hot_updated",
      "pg_stat_get_tuples_inserted",
      "pg_stat_get_tuples_returned",
      "pg_stat_get_tuples_updated",
      "pg_stat_get_vacuum_count",
      "pg_stat_get_wal_senders",
      "pg_stat_get_xact_blocks_fetched",
      "pg_stat_get_xact_blocks_hit",
      "pg_stat_get_xact_function_calls",
      "pg_stat_get_xact_function_self_time",
      "pg_stat_get_xact_function_time",
      "pg_stat_get_xact_numscans",
      "pg_stat_get_xact_tuples_deleted",
      "pg_stat_get_xact_tuples_fetched",
      "pg_stat_get_xact_tuples_hot_updated",
      "pg_stat_get_xact_tuples_inserted",
      "pg_stat_get_xact_tuples_returned",
      "pg_stat_get_xact_tuples_updated",
      "pg_stat_reset",
      "pg_stat_reset_shared",
      "pg_stat_reset_single_function_counters",
      "pg_stat_reset_single_table_counters",
      "pg_stop_backup",
      "pg_switch_xlog",
      "pg_table_is_visible",
      "pg_table_size",
      "pg_tablespace_databases",
      "pg_tablespace_size",
      "pg_terminate_backend",
      "pg_timezone_abbrevs",
      "pg_timezone_names",
      "pg_total_relation_size",
      "pg_try_advisory_lock",
      "pg_try_advisory_lock_shared",
      "pg_try_advisory_xact_lock",
      "pg_try_advisory_xact_lock_shared",
      "pg_ts_config_is_visible",
      "pg_ts_dict_is_visible",
      "pg_ts_parser_is_visible",
      "pg_ts_template_is_visible",
      "pg_type_is_visible",
      "pg_typeof",
      "pg_xlogfile_name",
      "pg_xlogfile_name_offset",
      "pg_xlog_replay_pause",
      "pg_xlog_replay_resume",
      "pi",
      "plainto_tsquery",
      "plpgsql_call_handler",
      "plpgsql_inline_handler",
      "plpgsql_validator",
      "point",
      "point_above",
      "point_add",
      "point_below",
      "point_distance",
      "point_div",
      "point_eq",
      "point_horiz",
      "point_in",
      "point_left",
      "point_mul",
      "point_ne",
      "point_out",
      "point_recv",
      "point_right",
      "point_send",
      "point_sub",
      "point_vert",
      "poly_above",
      "poly_below",
      "poly_center",
      "poly_contain",
      "poly_contained",
      "poly_contain_pt",
      "poly_distance",
      "polygon",
      "poly_in",
      "poly_left",
      "poly_npoints",
      "poly_out",
      "poly_overabove",
      "poly_overbelow",
      "poly_overlap",
      "poly_overleft",
      "poly_overright",
      "poly_recv",
      "poly_right",
      "poly_same",
      "poly_send",
      "popen",
      "position",
      "positionjoinsel",
      "positionsel",
      "postgresql_fdw_validator",
      "pow",
      "power",
      "prsd_end",
      "prsd_headline",
      "prsd_lextype",
      "prsd_nexttoken",
      "prsd_start",
      "pt_contained_circle",
      "pt_contained_poly",
      "query_to_xml",
      "query_to_xml_and_xmlschema",
      "query_to_xmlschema",
      "querytree",
      "quote_ident",
      "quote_literal",
      "quote_nullable",
      "radians",
      "radius",
      "random",
      "rank",
      "record_eq",
      "record_ge",
      "record_gt",
      "record_in",
      "record_le",
      "record_lt",
      "record_ne",
      "record_out",
      "record_recv",
      "record_send",
      "regclass",
      "regclassin",
      "regclassout",
      "regclassrecv",
      "regclasssend",
      "regconfigin",
      "regconfigout",
      "regconfigrecv",
      "regconfigsend",
      "regdictionaryin",
      "regdictionaryout",
      "regdictionaryrecv",
      "regdictionarysend",
      "regexeqjoinsel",
      "regexeqsel",
      "regexnejoinsel",
      "regexnesel",
      "regexp_matches",
      "regexp_replace",
      "regexp_split_to_array",
      "regexp_split_to_table",
      "regoperatorin",
      "regoperatorout",
      "regoperatorrecv",
      "regoperatorsend",
      "regoperin",
      "regoperout",
      "regoperrecv",
      "regopersend",
      "regprocedurein",
      "regprocedureout",
      "regprocedurerecv",
      "regproceduresend",
      "regprocin",
      "regprocout",
      "regprocrecv",
      "regprocsend",
      "regr_avgx",
      "regr_avgy",
      "regr_count",
      "regr_intercept",
      "regr_r2",
      "regr_slope",
      "regr_sxx",
      "regr_sxy",
      "regr_syy",
      "regtypein",
      "regtypeout",
      "regtyperecv",
      "regtypesend",
      "reltime",
      "reltimeeq",
      "reltimege",
      "reltimegt",
      "reltimein",
      "reltimele",
      "reltimelt",
      "reltimene",
      "reltimeout",
      "reltimerecv",
      "reltimesend",
      "repeat",
      "replace",
      "reverse",
      "ri_fkey_cascade_del",
      "ri_fkey_cascade_upd",
      "ri_fkey_check_ins",
      "ri_fkey_check_upd",
      "ri_fkey_noaction_del",
      "ri_fkey_noaction_upd",
      "ri_fkey_restrict_del",
      "ri_fkey_restrict_upd",
      "ri_fkey_setdefault_del",
      "ri_fkey_setdefault_upd",
      "ri_fkey_setnull_del",
      "ri_fkey_setnull_upd",
      "right",
      "round",
      "row_number",
      "rpad",
      "rtrim",
      "scalargtjoinsel",
      "scalargtsel",
      "scalarltjoinsel",
      "scalarltsel",
      "schema_to_xml",
      "schema_to_xml_and_xmlschema",
      "schema_to_xmlschema",
      "session_user",
      "set_bit",
      "set_byte",
      "set_config",
      "set_masklen",
      "setseed",
      "setval",
      "setweight",
      "shell_in",
      "shell_out",
      "shift_jis_2004_to_euc_jis_2004",
      "shift_jis_2004_to_utf8",
      "shobj_description",
      "sign",
      "similar_escape",
      "sin",
      "sjis_to_euc_jp",
      "sjis_to_mic",
      "sjis_to_utf8",
      "slope",
      "smgreq",
      "smgrin",
      "smgrne",
      "smgrout",
      "split_part",
      "sqrt",
      "statement_timestamp",
      "stddev",
      "stddev_pop",
      "stddev_samp",
      "string_agg",
      "string_agg_finalfn",
      "string_agg_transfn",
      "string_to_array",
      "strip",
      "strpos",
      "substr",
      "substring",
      "sum",
      "suppress_redundant_updates_trigger",
      "table_to_xml",
      "table_to_xml_and_xmlschema",
      "table_to_xmlschema",
      "tan",
      "text",
      "textanycat",
      "textcat",
      "texteq",
      "text_ge",
      "text_gt",
      "texticlike",
      "texticnlike",
      "texticregexeq",
      "texticregexne",
      "textin",
      "text_larger",
      "text_le",
      "textlen",
      "textlike",
      "text_lt",
      "textne",
      "textnlike",
      "textout",
      "text_pattern_ge",
      "text_pattern_gt",
      "text_pattern_le",
      "text_pattern_lt",
      "textrecv",
      "textregexeq",
      "textregexne",
      "textsend",
      "text_smaller",
      "thesaurus_init",
      "thesaurus_lexize",
      "tideq",
      "tidge",
      "tidgt",
      "tidin",
      "tidlarger",
      "tidle",
      "tidlt",
      "tidne",
      "tidout",
      "tidrecv",
      "tidsend",
      "tidsmaller",
      "time",
      "time_cmp",
      "timedate_pl",
      "time_eq",
      "time_ge",
      "time_gt",
      "time_hash",
      "time_in",
      "time_larger",
      "time_le",
      "time_lt",
      "timemi",
      "time_mi_interval",
      "time_mi_time",
      "time_ne",
      "timenow",
      "timeofday",
      "time_out",
      "timepl",
      "time_pl_interval",
      "time_recv",
      "time_send",
      "time_smaller",
      "timestamp",
      "timestamp_cmp",
      "timestamp_cmp_date",
      "timestamp_cmp_timestamptz",
      "timestamp_eq",
      "timestamp_eq_date",
      "timestamp_eq_timestamptz",
      "timestamp_ge",
      "timestamp_ge_date",
      "timestamp_ge_timestamptz",
      "timestamp_gt",
      "timestamp_gt_date",
      "timestamp_gt_timestamptz",
      "timestamp_hash",
      "timestamp_in",
      "timestamp_larger",
      "timestamp_le",
      "timestamp_le_date",
      "timestamp_le_timestamptz",
      "timestamp_lt",
      "timestamp_lt_date",
      "timestamp_lt_timestamptz",
      "timestamp_mi",
      "timestamp_mi_interval",
      "timestamp_ne",
      "timestamp_ne_date",
      "timestamp_ne_timestamptz",
      "timestamp_out",
      "timestamp_pl_interval",
      "timestamp_recv",
      "timestamp_send",
      "timestamp_smaller",
      "timestamptypmodin",
      "timestamptypmodout",
      "timestamptz",
      "timestamptz_cmp",
      "timestamptz_cmp_date",
      "timestamptz_cmp_timestamp",
      "timestamptz_eq",
      "timestamptz_eq_date",
      "timestamptz_eq_timestamp",
      "timestamptz_ge",
      "timestamptz_ge_date",
      "timestamptz_ge_timestamp",
      "timestamptz_gt",
      "timestamptz_gt_date",
      "timestamptz_gt_timestamp",
      "timestamptz_in",
      "timestamptz_larger",
      "timestamptz_le",
      "timestamptz_le_date",
      "timestamptz_le_timestamp",
      "timestamptz_lt",
      "timestamptz_lt_date",
      "timestamptz_lt_timestamp",
      "timestamptz_mi",
      "timestamptz_mi_interval",
      "timestamptz_ne",
      "timestamptz_ne_date",
      "timestamptz_ne_timestamp",
      "timestamptz_out",
      "timestamptz_pl_interval",
      "timestamptz_recv",
      "timestamptz_send",
      "timestamptz_smaller",
      "timestamptztypmodin",
      "timestamptztypmodout",
      "timetypmodin",
      "timetypmodout",
      "timetz",
      "timetz_cmp",
      "timetzdate_pl",
      "timetz_eq",
      "timetz_ge",
      "timetz_gt",
      "timetz_hash",
      "timetz_in",
      "timetz_larger",
      "timetz_le",
      "timetz_lt",
      "timetz_mi_interval",
      "timetz_ne",
      "timetz_out",
      "timetz_pl_interval",
      "timetz_recv",
      "timetz_send",
      "timetz_smaller",
      "timetztypmodin",
      "timetztypmodout",
      "timezone",
      "tinterval",
      "tintervalct",
      "tintervalend",
      "tintervaleq",
      "tintervalge",
      "tintervalgt",
      "tintervalin",
      "tintervalle",
      "tintervalleneq",
      "tintervallenge",
      "tintervallengt",
      "tintervallenle",
      "tintervallenlt",
      "tintervallenne",
      "tintervallt",
      "tintervalne",
      "tintervalout",
      "tintervalov",
      "tintervalrecv",
      "tintervalrel",
      "tintervalsame",
      "tintervalsend",
      "tintervalstart",
      "to_ascii",
      "to_char",
      "to_date",
      "to_hex",
      "to_number",
      "to_timestamp",
      "to_tsquery",
      "to_tsvector",
      "transaction_timestamp",
      "translate",
      "trigger_in",
      "trigger_out",
      "trunc",
      "ts_debug",
      "ts_headline",
      "ts_lexize",
      "tsmatchjoinsel",
      "ts_match_qv",
      "tsmatchsel",
      "ts_match_tq",
      "ts_match_tt",
      "ts_match_vq",
      "ts_parse",
      "tsq_mcontained",
      "tsq_mcontains",
      "tsquery_and",
      "tsquery_cmp",
      "tsquery_eq",
      "tsquery_ge",
      "tsquery_gt",
      "tsqueryin",
      "tsquery_le",
      "tsquery_lt",
      "tsquery_ne",
      "tsquery_not",
      "tsquery_or",
      "tsqueryout",
      "tsqueryrecv",
      "tsquerysend",
      "ts_rank",
      "ts_rank_cd",
      "ts_rewrite",
      "ts_stat",
      "ts_token_type",
      "ts_typanalyze",
      "tsvector_cmp",
      "tsvector_concat",
      "tsvector_eq",
      "tsvector_ge",
      "tsvector_gt",
      "tsvectorin",
      "tsvector_le",
      "tsvector_lt",
      "tsvector_ne",
      "tsvectorout",
      "tsvectorrecv",
      "tsvectorsend",
      "tsvector_update_trigger",
      "tsvector_update_trigger_column",
      "txid_current",
      "txid_current_snapshot",
      "txid_snapshot_in",
      "txid_snapshot_out",
      "txid_snapshot_recv",
      "txid_snapshot_send",
      "txid_snapshot_xip",
      "txid_snapshot_xmax",
      "txid_snapshot_xmin",
      "txid_visible_in_snapshot",
      "uhc_to_utf8",
      "unique_key_recheck",
      "unknownin",
      "unknownout",
      "unknownrecv",
      "unknownsend",
      "unnest",
      "upper",
      "utf8_to_ascii",
      "utf8_to_big5",
      "utf8_to_euc_cn",
      "utf8_to_euc_jis_2004",
      "utf8_to_euc_jp",
      "utf8_to_euc_kr",
      "utf8_to_euc_tw",
      "utf8_to_gb18030",
      "utf8_to_gbk",
      "utf8_to_iso8859",
      "utf8_to_iso8859_1",
      "utf8_to_johab",
      "utf8_to_koi8r",
      "utf8_to_koi8u",
      "utf8_to_shift_jis_2004",
      "utf8_to_sjis",
      "utf8_to_uhc",
      "utf8_to_win",
      "uuid_cmp",
      "uuid_eq",
      "uuid_ge",
      "uuid_gt",
      "uuid_hash",
      "uuid_in",
      "uuid_le",
      "uuid_lt",
      "uuid_ne",
      "uuid_out",
      "uuid_recv",
      "uuid_send",
      "varbit",
      "varbitcmp",
      "varbiteq",
      "varbitge",
      "varbitgt",
      "varbit_in",
      "varbitle",
      "varbitlt",
      "varbitne",
      "varbit_out",
      "varbit_recv",
      "varbit_send",
      "varbittypmodin",
      "varbittypmodout",
      "varchar",
      "varcharin",
      "varcharout",
      "varcharrecv",
      "varcharsend",
      "varchartypmodin",
      "varchartypmodout",
      "variance",
      "var_pop",
      "var_samp",
      "version",
      "void_in",
      "void_out",
      "void_recv",
      "void_send",
      "width",
      "width_bucket",
      "win1250_to_latin2",
      "win1250_to_mic",
      "win1251_to_iso",
      "win1251_to_koi8r",
      "win1251_to_mic",
      "win1251_to_win866",
      "win866_to_iso",
      "win866_to_koi8r",
      "win866_to_mic",
      "win866_to_win1251",
      "win_to_utf8",
      "xideq",
      "xideqint4",
      "xidin",
      "xidout",
      "xidrecv",
      "xidsend",
      "xml",
      "xmlagg",
      "xmlcomment",
      "xmlconcat2",
      "xmlexists",
      "xml_in",
      "xml_is_well_formed",
      "xml_is_well_formed_content",
      "xml_is_well_formed_document",
      "xml_out",
      "xml_recv",
      "xml_send",
      "xmlvalidate",
      "xpath",
      "xpath_exists"
    );
  }

  /**
  * Sets if connection must be persistent or not
  * @param boolean $persistent
  */
  function SetPersistent($persistent = true)
  {
    $this->mPersistent = (bool) $persistent;
  }

  /**
  * Connects to the database with the given parameters
  * @param string $db Database's name
  * @param string $user Database's user
  * @param string $pwd Users' password
  * @param string $host Database's host
  */
  function Connect($db = false, $user = false, $pwd = false, $host = false)
  {
    /* Build connection string */
    if ($host)
    {
      $host = explode(":", $host);

      if ($host[0])
        $str = "host=$host[0]";
      else
        $str = "localhost";

      if (isset($host[1]))
        $str .= " port=$host[1]";
    }

    if ($user) $str .= " user=".$user;
    if ($pwd)  $str .= " password=".$pwd;
    if ($db)   $str .= " dbname=".$db;
 
    if ($this->mPersistent)
      $this->mConn = pg_pconnect($str);
    else
      $this->mConn = pg_connect($str);

    if (!$this->mConn)
      return false;
    
    if (!isset($_SESSION["s_functions"]) || sizeof($_SESSION["s_functions"]) == 0)
      $_SESSION["s_functions"] = $this->mFunctions;

    //Adiciona palavras reservadas no array, qdo tiver esses valores ele não vai colocar '
    
    $this->mReservedWords = array("is not null", "is null", "true", "false", "coalesce",
                                  "session_user", "current_user", "current_date", "current_timestamp",
                                  "current_time", "null", "not null", "localtime", "localtimestamp");
 
    /* Não é necessário usar tudo hoje
    $this->mReservedWords = array("is not null", "is null", "group", "trailing", "on", "constraint",
                                  "any", "collat", "array", "column", "cast", "not", "initially",
                                  "using", "asc", "analyze", "new", "true", "analyse", "where", "false",
                                  "to", "when", "or", "case", "end", "into", "as", "only", "offset", "user",
                                  "desc", "old", "placing", "do", "else", "create", "leading", "all", "some", 
                                  "intersect", "both", "having", "limit", "references", "default", "foreign",
                                  "for", "from", "union", "table", "primary", "grant", "select", "off", "except",
                                  "session_user", "current_user", "current_date", "unique", "current_timestamp",
                                  "current_time", "order", "check", "distinct", "then", "null", "localtime",
                                  "deferrable", "and", "localtimestamp");
    */
    
    return true;

  }

  /**
  * Executes an SQL statement
  * @param string  $sql The SQL statement
  * @param int $limit How many rows might be returned if the statement is a SELECT
  * @param int $offset How many rows mus be "jumped" from the begining of the recod set
  * @returns mixed True or recordset if success, false otherwise
  */
  function Execute($sql, $limit = false, $offset = false)
  {
    $firstString = substr(strtoupper(trim($sql)), 0, 6);

    if (strpos($firstString, "SELECT") !== false || strpos($firstString, "WITH") !== false)
    {
      if ($limit && is_int($limit))
        $sql .= " LIMIT $limit ";
      if ($offset && is_int($offset))
        $sql .= " OFFSET $offset ";
    }
    $this->SetLastSql($sql);
    $this->mResult = @pg_query($this->mConn, "/*" . $_SESSION["s_cd_usuario"] . "^" . basename($_SERVER["PHP_SELF"]) . "*/" . $sql);

    return $this->mResult;
  }

  /**
  * Returns the last inserted row
  * @param string $table_name Name of the table affected by the most recent INSERT statement
  */
  function GetInserted($table_name)
  {
/*  
    $sql = "SELECT oid, * FROM $table_name WHERE oid = " .
           pg_getlastoid($this->mResult);
    $this->mResult = pg_Exec($this->mConn, $sql);
*/
    $this->mResult = pg_query($this->mConn, $table_name);
    return $this->mResult;
  }

  /**
  * Opens a transaction
  * @returns boolean True in success, false otherwise
  */
  function BeginTransaction()
  {
    if (!$this->mHasTransaction)
    {
      $this->mHasTransaction = true;
      return $this->Execute("begin");
    }
  }

  /**
   * Creates a savepoint
   * @param $nmSavepoint
   * @return bool True in successful, false otherwise
   */
  function Savepoint($nmSavepoint)
  {
    if ($this->mHasTransaction && str_value($nmSavepoint))
    {
      $this->mHasTransaction = true;
      return $this->Execute("SAVEPOINT {$nmSavepoint}");
    }
    return false;
  }

  /**
   * Creates a savepoint
   * @param $nmSavepoint
   * @return bool True in successful, false otherwise
   */
  function ReleaseSavepoint($nmSavepoint)
  {
    if ($this->mHasTransaction && str_value($nmSavepoint))
    {
      $this->mHasTransaction = true;
      return $this->Execute("RELEASE SAVEPOINT {$nmSavepoint}");
    }
    return false;
  }

  /**
   * Rolls back to a savepoint
   * @param $nmSavepoint
   * @return bool True in successful, false otherwise
   */
  function RollbackToSavepoint($nmSavepoint)
  {
    if ($this->mHasTransaction && str_value($nmSavepoint))
    {
      $this->mHasTransaction = true;
      return $this->Execute("ROLLBACK TO SAVEPOINT {$nmSavepoint}");
    }
    return false;
  }

  /**
  * Commits a transaction
  * @returns boolean True in success, false otherwise
  */
  function Commit()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      return $this->Execute("commit");
    }
  }

  /**
  * Rolls back a open transaction
  * @returns boolean True in success, false otherwise
  */
  function Rollback()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      return $this->Execute("rollback");
    }
  }

  /**
  * Closes the database connection
  * @returns boolean True in success, false otherwise
  */
  function Close()
  {
    if (!$this->mPersistent)
      return pg_close($this->mConn);
    /*
      depending on web server configuration (php.ini) persistent connections 
      doesn't remain when a pg_close is called, which is bad for performance reasons,
      so once the idea of persistent connections have been chosen you don't need to close the connection anyway
    */
    return true;
  }

  function QuoteValue($value)
  {
    if (in_array(strtolower($value), $this->mReservedWords) ||
        in_array(strtolower(substr($value, 0, strpos($value, "("))) , $this->mReservedWords) ||
        (strpos($value, "(") && in_array(strtolower(substr($value, 0, strpos($value, "("))) , $this->mFunctions)))
      $out = $value;
    else if (!strlen($value))
      $out = "NULL";
    else if (substr($value, 0, 1) == "(" && substr($value, -1) == ")")
      $out = $value;
    else
    {
      $array = array("\\\"" => "&quot;", "'" => "\\'");
      $value = strtr($value, $array);

      // replace all  \n \t \r ... with \\n \\t \\r ...
      $pattern = "/([^\\\\])\\\\([a-z])/i";
      $replacement = "$1\\\\\\\\$2";
      $value = preg_replace($pattern, $replacement, preg_replace($pattern, $replacement, $value));

      $array = array("\\\\'" => "\\'");
      $value = strtr($value, $array);
      
      $value = "'" . trim($value) . "'";
      
      $out = (strpos($value, "\\")!==false?"E".$value:$value);
    }
    

    return $out;
  }

  /**
  * Returns a significative description of the error or sends an warning e-mail
  * @returns string
  */
  function GetError()
  {
    $original_string = pg_last_error($this->mConn);
    if (strlen($original_string) == 0)
      return "";

    $string = strtr($original_string, array("\n" => ""));
    $error  = explode(" ", $string);

    $out = "";

    if (($error[3]." ".$error[4]." ".$error[5]) ==
         "referential integrity violation")
    {
      $out = "ERRO: Violação de Integridade Referencial! " .
             "Chave em <b>" .$error[9] . "</b> ainda referenciada em <b>".$error[13]."</b>.";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".
             $error[5]." ".$error[6]) ==
            "Cannot insert a duplicate key")
    {
      $out = "ERRO: Violação de Integridade Referencial! " .
             "Chave primária duplicada.";
    }
    elseif (($error[3]." ".$error[4]) == "Permission denied.")
    {
      $out = "ERRO: Permissao Negada no Acesso ao Banco de Dados! " .
             "Contate o Administrador do sistema.";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]." ".$error[6]) ==
            "Relation does not exist")
    {
      $out = "ERRO: Tabela ".$error[3]." não existe! " .
             "Contate o Administrador do sistema.";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]." ".$error[9]." ".
             $error[10]." ".$error[11]) ==
            "ExecAppend: Fail to add null value in not null attribute")
    {
      $out = "ERRO: Campo obrigatório não preenchido => '$error[12]'! ";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]) ==
            "Attribute not found")
    {
      $out = "ERRO: Atributo '".$error[3]."' não encontrado!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]) ==
            "No such attribute or function")
    {
      $out = "ERRO: Atributo ou função não existe: '".$error[7]."'";
    }
     elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
              $error[6]." ".$error[7]) ==
            "parser: parse error at or near")
    {
      $out = "ERRO: próximo ou em: '".$error[8]."'";
    }
    elseif (($error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]." ".$error[9]." ".
             $error[10]." ".$error[11]) ==
            "Fail to add null value in not null attribute")
    {
      $out = "ERRO: Campo obrigatório não preenchido => '$error[12]'! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]) ==
            "Bad numeric input format")
    {
      $out = "ERRO: Formato numérico inválido: '".$error[6]."'";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]) ==
            "backend closed the channel")
    {
      $out = "ERRO: Conexão fechada anormalmente pelo servidor.";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]) ==
            "Column is ambiguous")
    {
      $out = "ERRO: Coluna '".$error[3]."' definida de maneira ambígüa.";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]) ==
            "ExecReplace: rejected due to CHECK constraint")
    {
      $out = "ERRO: Restrição de checagem violada '".$error[8]."'.";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]) ==
            "Unable to convert null timestamp to date")
    {
      $out = "ERRO: Não é possível converter NULL para data! ";
    }
    elseif (($error[2]." ".$error[5]." ".$error[6]) ==
            "Bad external representation")
    {
      $out = "ERRO: Representacao incorreta de tipo " . $error[4] . "! ";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]." ".$error[6]." ".
             $error[7]) ==
            "Relation does not have attribute")
    {
      $out = "ERRO: A tabela '".$error[3]."' não possui o campo: '".$error[8]."'";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]) ==
            "No such attribute")
    {
      $out = "ERRO: O atributo '".$error[5]."' não existe! ";
    }
    elseif (($error[5]." ".$error[6]." ".$error[7]." ".$error[8]." ") ==
            "Missing data for column")
    {
      $out = "ERRO: Faltando dados para a coluna ".$error[9]."! ";
    }
    elseif (($error[5]." ".$error[6]." ".$error[7]." ".$error[8]." ".
             $error[9]." ".$error[10]." ".$error[11]) ==
            "Cannot insert a duplicate key into unique")
    {
      $out = "ERRO: Não é possível inserir valores duplicados na chave única ".$error[13]."! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]." ".$error[9]." ".
             $error[10]." ".$error[11]." ".$error[12]) ==
            "current transaction is aborted, queries ignored until end of transaction block")
    {
      $out = "ERRO: Transação atual abortada. Todas as queries serão ignoradas até o final da transação! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]." ".$error[9]." ".
             $error[10]." ".$error[11]." ".$error[12]) ==
            "current transaction is aborted, commands ignored until end of transaction block")
    {
      $out = "ERRO: Transação atual cancelada. Todos os comandos serão ignorados até o final da transação! ";
    }
    elseif (($error[3]." ".$error[4]) ==
            "permission denied")
    {
      $out = "ERRO: Permissão negada em <b>".$error[2]."</b>!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[5]." ".$error[6]." ") ==
            "Column reference is ambiguous")
    {
      $out = "ERRO: A referência a coluna ".$error[9]." é ambigua! ";
    }

/*    
    elseif (($error[2]." ".$error[4]." ".$error[6]." ".$error[7]." ".
             $error[8]." ".$error[9]." ".$error[10]) ==
            "constraint table does not have an attribute")
    {
      $out = "ERRO: Constraint '".$error[3]."': tabela ".$error[5]." não possui o atributo ".$error[11]."! ";
    }
*/    
    elseif (($error[2]." ".$error[3]." ".$error[4]) ==
            "pg_atoi: zero-length string")
    {
      $out = "ERRO: Não é possível converter uma string vazia em inteiro! ";
    }
    elseif (($error[3]." ".$error[4]) ==
            "permission denied")
    {
      $out = "ERRO: Permissão negada em <b>'".$error[2]."'</b>! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[8]) ==
            "parser: parse error at end of input")
    {
      $out = "ERRO: Erro de sintaxe no final da entrada! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]) ==
            "Unable to identify an operator")
    {
      $out = "ERRO: Não foi possível identificar o operador <b>".$error[7]."</b>" . 
             "para os tipos <b>".$error[10]."</b> e <b>".$error[12]."</b>!";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]." ".$error[6]." ") ==
            "Relation has no column")
    {
      $out = "ERRO: A tabela ".$error[3]." não possui a coluna ".$error[7]."! ";
    }
    elseif (($error[2]." ".$error[4]." ".$error[5]." ".$error[6]." ") ==
            "Function does not exist")
    {
      $out = "ERRO: A função ".$error[3]." não existe! ";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]) ==
            "value too long for type")
    {
      $out = "ERRO: Valor muito longo para uma coluna <b>".$error[6]." ".$error[7]."</b>!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]." ".
             $error[6]." ".$error[7]." ".$error[7]) ==
            "parser: parse error at end of input")
    {
      $out = "ERRO: Interpretador: Erro no final da entrada!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[5]." ".$error[6]) ==
            "Column reference is ambiguous")
    {
      $out = "ERRO: A referência a coluna <b>" . $error[4] . "</b> é ambigua!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[5]) ==
            "Bad timestamp external representation")
    {
      $out = "ERRO: Representacao de timestamp invalida <b>" . $error[6] . $error[7]. "</b>!";
    }
    elseif (($error[2]." ".$error[3]." ".$error[4]." ".$error[6]." ".
             $error[7]) ==
            "pg_atoi: error in can't parse")
    {
      $out = "ERRO: Valor muito longo para uma coluna <b>".$error[6]." ".$error[7]."</b>!";
    }
    elseif (($error[2] ." ".$error[3] ." ".$error[4] ." ".$error[5]." ".
             $error[6] ." ".$error[7] ." ".$error[8] ." ".$error[9]." ".
             $error[10]." ".$error[11]." ".$error[12]." ".$error[12]) ==
            "More than one tuple returned by a subselect used as an expression")
    {
      $out = "ERRO: Mais de uma tupla retornada por um subselect utilizado como uma expressão! ";
    }
    elseif (strtolower($error[2] ." ".$error[3] ." ".$error[4] ." ".$error[5]." ".
             $error[6] ." ".$error[7] ." ".$error[8] ." ".$error[9]." ".
             $error[10]." ".$error[11]." ".$error[12]." ".$error[13]) ==
            "more than one row returned by a subquery used as an expression")
    {
      $out = "ERRO: Mais de uma linha retornada por um subselect utilizado como uma expressão! ";
    }
    elseif (strtolower($error[2]." ".$error[3]." ".$error[4]) == "division by zero")
    {
      $out = "ERRO: Divisão por zero! ";
    }
    elseif (implode("", $error) == "ERRO:cancelandocomandoporcausadotempodeespera(timeout)docomando" ||
            implode("", $error) == "ERROR:cancelingstatementduetostatementtimeout")
    {
      $out = "Este processo excedeu o tempo limite de execução, por favor entre em contato com o nosso suporte!";
    }
    else
    {
      $out = "=>".$_SERVER["PHP_SELF"]."\n\n".$original_string."\n\n";

      $description = "";
      for($i = 0; $i < sizeof($error); $i++)
        $description .= "Error[$i]: $error[$i]\n";

//      mail("al_nunes@atua.com.br", "Classe JDB - Novo Erro Driver Pgsql", $out.$description);
    }

    return $out;
  }

  /**
  * Stores the last SQL statement sent to the PostgreSQL backend
  * @param string $lastSql A SQL statement
  */
  function SetLastSql($lastSql = false)
  {
    $this->mLastSql = $lastSql;
  }

  /**
  * Builds the call to the database function tha auto-increments a field
  * @return string
  */
  function GetIncrementalKey($key, $table = false, $schema = false)
  {
    $sql = "SELECT pg_get_serial_sequence('$table', '$key')";

    $rs = pg_query($this->mConn, $sql);

    $arr = pg_fetch_array($rs, 0);

    if (!$arr) echo "<hr><b>--->Erro: Aparentemente ".$key." não é uma chave incremental na tabela ".$table."</b>";

    $sql = "SELECT NEXTVAL('" . $arr[0] . "')";

    $rs = pg_query($this->mConn, $sql);
                
    $arr = pg_fetch_array($rs, 0);

    return $arr[0]; 
  }
  
  /**
   * Test if table exists
   * @param string table name
   * @return boolean
   */
  function TableExists($table_name)
  {
    $sql = "SELECT to_regclass('$table_name') AS count";
    $rs = pg_query($this->mConn, $sql);
    $arr = pg_fetch_array($rs, 0);

    return ($arr["count"]!= ''?true:false);
  }

  /**
   * test if sequence exists
   * @param string $sequence sequence name
   * @return boolean 
   */
  function SequenceExists($sequence)
  {
    $sql = "SELECT COUNT(*) FROM information_schema.sequences WHERE sequence_name = '$sequence'";
    $rs = pg_query($this->mConn, $sql);
    $arr = pg_fetch_array($rs, 0);

    return ($arr["count"]>=1?true:false);
  }

  /**
   * create sequences
   * @param string $sequence_name
   * @param int $start
   */
  function CreateSequence($sequence_name, $start)
  {
    $sql = "CREATE SEQUENCE $sequence_name 
              INCREMENT 1
              MINVALUE  0000000001
              MAXVALUE  9999999999
              START     $start 
              CACHE     1";

    return pg_query($this->mConn, $sql);
  }

  /**
   * test if field exists in a table
   * @param type $table_name
   * @param type $field_name
   * @return type
   */
  function FieldExists($table_name, $field_name)
  {
    $sql = "SELECT COUNT(*) FROM pg_attribute WHERE attrelid = '$table_name'::regclass AND attname = '$field_name' AND NOT attisdropped";

    $rs      = @pg_query($this->mConn, $sql);
    $msgErro = pg_last_error($this->mConn);

    //verifica se não tem erro na consulta ou se esse erro não é da consulta acima
    if (strlen($msgErro) == 0 ||
        (strpos($msgErro, $table_name) === false && strpos($msgErro, $field_name) === false))
    {
      $arr = pg_fetch_array($rs, 0);
      return ($arr["count"] >= 1 ? true : false);
    }

    return false;
  }
}

/**
* PostgreSQL recod set manipulation class
*
* @author  Atua Sistemas de Informacao
* @since   2002-06-01
* @package Jaguar
*/
Class JDBRSPgsql
{
  /**
  * Stores the result set
  * @var JDBRS
  */
  var $mResult;

  /**
  * Sets the result set
  */
  function Result($result)
  {
    $this->mResult = $result;
    $this->mIndex  = -1;
  }

  /**
  * Gets the number of columns from the record set
  * @returns int
  */
  function GetRowCount()
  {
    return @pg_numrows($this->mResult);
  }

  /**
  * Gets the number of fields from the record set
  * @returns int
  */
  function GetFieldCount()
  {
    return @pg_numfields($this->mResult);
  }

  /**
  * Gets the field names from the record set
  * @returns array
  */
  function GetFieldNames()
  {
    $top = @pg_numfields($this->mResult);
    for ($i=0; $i<$top; $i++)
    {
      $name = pg_fieldname($this->mResult, $i);
      $arr[$name]["number"] = $i;
//      $arr[$name]["type"] = pg_fieldtype($this->mResult, $i);
      $arr[$name]["size"] = pg_fieldsize($this->mResult, $i);
    }
    return $arr;
  }

  /**
  * Jumps to the next row in the record set
  * @returns array 
  */
  function Next()
  {
    $this->mIndex++;
    return pg_fetch_row($this->mResult, $this->mIndex); //, PGSQL_NUM);
  }

  /**
  * Returns to the beginning from result set
  */
  function Reset()
  {
    $this->mIndex = -1;
  }

  /**
  * Close the result set
  * @returns boolean
  */
  function Close()
  {
    return pg_freeresult($this->mResult);
  }
}