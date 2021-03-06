<?php
    /*
     * db.php: A slender database wrapper.
     *
     * Copyright (C) 2011 Dionysis "dionyziz" Zindros <dionyziz@gmail.com>
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
    */

    // global $settings;
    // mysql_connect( 'localhost', $settings[ 'db' ][ 'user' ], $settings[ 'db' ][ 'password' ] ) or die( mysql_error() );
    // mysql_select_db( $settings[ 'db' ][ 'name' ] ) or die( mysql_error() );

    function db_connect( $username, $password, $host = 'localhost' ) {
        $link = @mysql_connect( $host, $username, $password );
        if ( $link !== false ) {
            mysql_query( 'SET NAMES utf8' );
        }
        return $link;
    }

    function db( $sql, $bind = false ) {
        if ( $bind == false ) {
            $bind = array();
        }
        foreach ( $bind as $key => $value ) {
            if ( is_string( $value ) ) {
                $value = addslashes( $value );
                $value = '"' . $value . '"';
            }
            else if ( is_array( $value ) ) {
                foreach ( $value as $i => $subvalue ) {
                    $value[ $i ] = addslashes( $subvalue );
                }
                $value = "('" . implode( "', '", $value ) . "')";
            }
            else if ( is_null( $value ) ) {
                $value = '""';
            }
            $bind[ ':' . $key ] = $value;
            unset( $bind[ $key ] );
        }
        $finalsql = strtr( $sql, $bind );
        $res = mysql_query( $finalsql );
        if ( $res === false ) {
            throw new Exception(
                "SQL query failed with the following error:\n\""
                . mysql_error()
                . "\"\n\nThe query given was:\n"
                . $sql
                . "\n\nThe SQL bindings were:\n"
                . print_r( $bind, true )
                . "The query executed was:\n"
                . $finalsql
            );
        }
        return $res;
    }
    function db_array( $sql, $bind = false, $id_column = false, $assoc = MYSQL_BOTH ) {
        $res = db( $sql, $bind );
        $rows = array();
        if ( $id_column !== false ) {
            while ( $row = mysql_fetch_array( $res, $assoc ) ) {
                $rows[ $row[ $id_column ] ] = $row;
            }
        }
        else {
            while ( $row = mysql_fetch_array( $res, $assoc ) ) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    function db_insert( $table, $set ) {
        $fields = array();
        foreach ( $set as $field => $value ) {
            $fields[] = "$field = :$field";
        }
        db(
            'INSERT INTO '
            . $table
            . ' SET '
            . implode( ',', $fields ),
            $set
        );
        return mysql_insert_id();
    }
    function db_delete( $table, $where, $limit = 0 ) {
        assert( is_numeric( $limit ) );
        $fields = array();
        foreach ( $where as $field => $value ) {
            $fields[] = "$field = :$field";
        }
        $sql = 'DELETE FROM '
                . $table
                . ' WHERE '
                . implode( ' AND ', $fields );
        if ( $limit > 0 ) {
            $sql .= ' LIMIT ' . $limit;
        }
        db(
            $sql,
            $where,
            $limit
        );
        return mysql_affected_rows();
    }
    function db_update( $table, $where, $set ) {
        $wfields = array();
        $wreplace = array();
        foreach ( $where as $field => $value ) {
            $wfields[] = "$field = :where_$field";
            $wreplace[ 'where_' . $field ] = $value;
        }
        $sfields = array();
        $sreplace = array();
        foreach ( $set as $field => $value ) {
            $sfields[] = "$field = :set_$field";
            $sreplace[ 'set_' . $field ] = $value;
        }
        db(
            'UPDATE '
            . $table .
            ' SET '
            . implode( ', ', $sfields ) .
            ' WHERE '
            . implode( ' AND ', $wfields ),
            array_merge( $wreplace, $sreplace )
        );
        return mysql_affected_rows();
    }
    function db_select( $table, $where ) {
        $wreplace = array();
        $wfields = array();
        foreach ( $where as $field => $value ) {
            $wfields[] = "$field = :where_$field";
            $wreplace[ 'where_' . $field ] = $value;
        }
        return db_array(
            'SELECT
                *
            FROM
                ' . $table . '
            WHERE
                ' . implode( ' AND ', $wfields ),
                $wreplace
        );
    }
    function db_fetch( $res ) {
        $ret = array();
        while ( $row = mysql_fetch_array( $res ) ) {
            $ret[] = $row;
        }
        return $ret;
    }
?>
