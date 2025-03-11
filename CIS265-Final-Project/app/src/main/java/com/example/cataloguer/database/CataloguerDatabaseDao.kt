package com.example.cataloguer.database

import androidx.lifecycle.LiveData
import androidx.room.Dao
import androidx.room.Insert
import androidx.room.Query
import androidx.room.Update

@Dao
interface CataloguerDatabaseDao {

    // create entry
    @Insert
    fun insert(entry: CataloguerDB)

    @Update
    fun update(entry: CataloguerDB)

    // find specific entry
    @Query("SELECT * FROM cataloguer_information_table WHERE entryId = :key")
    fun get(key: Long): CataloguerDB?

    // delete all entries
    @Query("DELETE FROM cataloguer_information_table")
    fun clear()

    // return every entry created
    @Query("SELECT * FROM cataloguer_information_table ORDER BY entryId ASC")
    fun getAllEntries(): LiveData<List<CataloguerDB>>

    // return the very last entry created
    @Query("SELECT * FROM cataloguer_information_table ORDER BY entryId DESC LIMIT 1")
    fun getLastEntry(): CataloguerDB

}