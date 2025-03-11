package com.example.cataloguer.ui.create

//import androidx.lifecycle.ViewModelProvider
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.databinding.DataBindingUtil
import androidx.fragment.app.Fragment
import androidx.lifecycle.ViewModelProviders
import com.example.cataloguer.R
import com.example.cataloguer.database.CataloguerDatabase
import com.example.cataloguer.databinding.FragmentCreateBinding

class CreateFragment : Fragment() {

    override fun onCreateView(
            inflater: LayoutInflater,
            container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {

        // create binding
        val binding: FragmentCreateBinding = DataBindingUtil.inflate(inflater, R.layout.fragment_create, container, false)

        // create application and data variables required for building the viewModelFactory
        val application = requireNotNull(this.activity).application
        val dataSource = CataloguerDatabase.getInstance(application).cataloguerDatabaseDao
        val viewModelFactory = CreateViewModelFactory(dataSource, application)

        // create the actual viewModelFactory
        val createViewModel = ViewModelProviders.of(this, viewModelFactory).get(CreateViewModel::class.java)

        binding.setLifecycleOwner(this)
        binding.createViewModel = createViewModel

        // return the root
        return binding.root
    }
}