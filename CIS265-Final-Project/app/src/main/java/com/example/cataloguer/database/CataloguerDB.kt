package com.example.cataloguer.database

import androidx.room.ColumnInfo
import androidx.room.Entity
import androidx.room.PrimaryKey

// creates the names for the table used by the app as well as all columns
@Entity(tableName = "cataloguer_information_table")
data class CataloguerDB (

    @PrimaryKey(autoGenerate = true)
    var entryId: Long = 0L,

    @ColumnInfo(name = "entry_title")
    var entryTitle: String?,

    @ColumnInfo(name = "entry_author")
    var entryAuthor: String?,

    @ColumnInfo(name = "entry_release_year")
    var entryReleaseYear: Int?,

    @ColumnInfo(name = "entry_special_info")
    var entrySpecialInfo: String?

)


