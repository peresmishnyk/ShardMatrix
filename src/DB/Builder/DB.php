<?php


namespace ShardMatrix\Db\Builder;


use ShardMatrix\DB\Interfaces\DBDataRowTransactionsInterface;
use ShardMatrix\ShardMatrix;


/**
 * Class DB
 * @package ShardMatrix\Db\Illuminate
 * @method static QueryBuilder table( string $table, string $as = null )
 * @method static DBDataRowTransactionsInterface getByUuid( $uuid )
 * @method static bool updateByUuid( $uuid, array $values )
 * @method static QueryBuilder allNodesTable( string $table, string $as = null )
 * @method static QueryBuilder shardTable( string $table, string $as = null )
 */
class DB extends \Illuminate\Support\Facades\DB {

	static public function __callStatic( $method, $args ) {

		$instance = new UnassignedConnection();

		return $instance->$method( ...$args );
	}

	/**
	 * node name
	 * @param string $name
	 *
	 * @return ShardMatrixConnection
	 */
	static public function connection( string $name ) {
		$node = ShardMatrix::getConfig()->getNodes()->getNodeByName( $name );

		return ( new ShardMatrixConnection( $node ) );
	}

}