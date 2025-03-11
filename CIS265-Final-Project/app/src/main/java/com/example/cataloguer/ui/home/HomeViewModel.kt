package com.example.cataloguer.ui.home

import android.app.Application
import androidx.lifecycle.AndroidViewModel
import androidx.lifecycle.MutableLiveData
import com.example.cataloguer.database.CataloguerDB
import com.example.cataloguer.database.CataloguerDatabaseDao
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.Job
import kotlinx.coroutines.withContext

class HomeViewModel(val database: CataloguerDatabaseDao, application: Application) : AndroidViewModel(application) {

    private var viewModelJob = Job()

    var entry = MutableLiveData<List<CataloguerDB?>>()

    private val uiScope = CoroutineScope(Dispatchers.Main + viewModelJob)

    // function used to return all entries from the Room database
    private suspend fun getEntryFromDatabase() {
        return withContext(Dispatchers.IO) {
            var entry = database.getAllEntries()
            entry
        }

    }

}